<?php
session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

// Verifica si se recibió el ID de la publicación
if (!isset($_POST['ID_Clase']) || !is_numeric($_POST['ID_Clase'])) {
    die("ID de clase no válido.");
}

$ID_Clase = intval($_POST['ID_Clase']);

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Primero obtener el ID antes de eliminar
$sqlGetClase = "SELECT ID FROM CLASES WHERE ID_Clase=?";
$stmtGet = $conn->prepare($sqlGetClase);
$stmtGet->bind_param("i", $ID_Clase);
$stmtGet->execute();
$result = $stmtGet->get_result();

if ($result->num_rows > 0) {
    $clase = $result->fetch_assoc()['ID'];
    $stmtGet->close();

    // Ahora eliminar la publicación
    $sql = "DELETE FROM CLASES WHERE ID_Clase = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID_Clase);

    if ($stmt->execute()) {
        header("Location: inicioPR.php?");
        exit();
    } else {
        echo "Error al eliminar la clase: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se encontró la clase.";
}

$conn->close();
?>
