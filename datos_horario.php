<?php
include("bd.php");
session_start();

if (!isset($_SESSION['ci']) || $_SESSION['rol'] != 3) {
    die("Acceso denegado");
}

$ci = $_SESSION['ci'];
$dia = trim($_POST['dia']);
$uploadDir = "media/";

if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['archivo']['tmp_name'];
    $fileName = basename($_FILES['archivo']['name']);
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $permitidos = ["jpg","jpeg","png","gif","webp"];
    if (!in_array($fileExt, $permitidos)) {
        die("Formato de imagen no permitido");
    }

    $nuevoNombre = "horario_" . strtolower($dia) . "_" . time() . "." . $fileExt;
    $destino = $uploadDir . $nuevoNombre;

    if (move_uploaded_file($fileTmp, $destino)) {
        // Insertar o actualizar el horario del día
        $sql = "INSERT INTO horario (Id_usuario, Dia, Imagen)
                VALUES (?, ?, ?)
                ON DUPLICATE KEY UPDATE Imagen = VALUES(Imagen)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iss", $ci, $dia, $destino);
        $stmt->execute();
        $stmt->close();

        header("Location: horarios.php");
        exit();
    } else {
        echo "Error al subir la imagen.";
    }
} else {
    echo "No se ha seleccionado un archivo válido.";
}
?>
