<?php
session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

// Verifica si se recibió el ID de la publicación
if (!isset($_POST['idP']) || !is_numeric($_POST['idP'])) {
    die("ID de publicación no válido.");
}

$idP = intval($_POST['idP']);

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Primero obtener el CLASES_ID antes de eliminar
$sqlGetClase = "SELECT CLASES_ID FROM PUBLICACIONES WHERE idP=?";
$stmtGet = $conn->prepare($sqlGetClase);
$stmtGet->bind_param("i", $idP);
$stmtGet->execute();
$result = $stmtGet->get_result();

if ($result->num_rows > 0) {
    $clase = $result->fetch_assoc()['CLASES_ID'];
    $stmtGet->close();

    // Ahora eliminar la publicación
    $sql = "DELETE FROM PUBLICACIONES WHERE idP = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idP);

    if ($stmt->execute()) {
        header("Location: clases_pr.php?ID=$clase");
        exit();
    } else {
        echo "Error al eliminar la publicación: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se encontró la publicación.";
}

$conn->close();
?>
