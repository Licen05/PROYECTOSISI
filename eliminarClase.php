<?php
session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

// Verifica si se recibió el ID de la publicación
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    die("ID de clase no válido.");
}

$ID = intval($_GET['ID']);

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
$sqlGetClase = "SELECT ID FROM CLASES WHERE ID= ?";
$stmtGet = $conn->prepare($sqlGetClase);
$stmtGet->bind_param("i", $ID);
$stmtGet->execute();
$result = $stmtGet->get_result();

if ($result->num_rows > 0) {
    $clase = $result->fetch_assoc()['ID'];
    $stmtGet->close();

    // Ahora eliminar la publicación
    $sql = "DELETE FROM CLASES WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);

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
