<?php
session_start();

// Crear conexión antes de cualquier consulta
$conn = new mysqli("localhost", "root", "", "proyectoSISI");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Variables POST
    $asunto = $_POST['asu'] ?? '';
    $contenido = $_POST['conte'] ?? '';
    $archivo = $_FILES['archi'] ?? '';
    $idP = $_POST['idP'] ?? '';

    if (!empty($asunto) && !empty($contenido) && !empty($idP)) {

        // 1) Verificar autor
        $sqlVerif = "SELECT Autor FROM PUBLICACIONES WHERE idP = ?";
        $stmtVerif = $conn->prepare($sqlVerif);
        $stmtVerif->bind_param("i", $idP);
        $stmtVerif->execute();
        $resVerif = $stmtVerif->get_result();

        if ($resVerif->num_rows > 0) {
            $autor = $resVerif->fetch_assoc()['Autor'];

            $ciSesion = $_SESSION['ci'];
            $sqlNombre = "SELECT Nombres FROM informacion WHERE CI = ?";
            $stmtNombre = $conn->prepare($sqlNombre);
            $stmtNombre->bind_param("s", $ciSesion);
            $stmtNombre->execute();
            $resNombre = $stmtNombre->get_result();
            $nombreSesion = $resNombre->fetch_assoc()['Nombres'];

            if (trim($autor) !== trim($nombreSesion)) {
                die("No tienes permiso para editar esta publicación.");
            }
        }

        // 2) Actualizar publicación
        date_default_timezone_set('America/La_Paz');
        $fechaEdicion = date("Y-m-d H:i:s");

        $sql = "UPDATE PUBLICACIONES SET Asunto=?, Texto=?, Archivo=?, FechaE=? WHERE idP=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $asunto, $contenido, $archivo, $fechaEdicion, $idP);

        if ($stmt->execute()) {
            // Obtener la clase
            $sqlGetClase = "SELECT CLASES_ID FROM PUBLICACIONES WHERE idP=?";
            $stmtGet = $conn->prepare($sqlGetClase);
            $stmtGet->bind_param("i", $idP);
            $stmtGet->execute();
            $result = $stmtGet->get_result();

            if ($result->num_rows > 0) {
                $clase = $result->fetch_assoc()['CLASES_ID'];
                if ($_SESSION['rol'] == 1)
                    header("Location: clases.php?ID=$clase");
                if ($_SESSION['rol'] == 2)
                    header("Location: clases_pr.php?ID=$clase");
                exit();
            } else {
                echo "Publicación actualizada, pero no se encontró la clase.";
            }
        } else {
            echo "Error al actualizar la publicación: " . $stmt->error;
        }
    } else {
        echo "Faltan datos.";
    }
} else {
    echo "Acceso no permitido.";
}

$conn->close();
?>
