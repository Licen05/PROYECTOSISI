<?php
session_start();
include("bd.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 2) {
    die("Acceso denegado: solo los profesores pueden eliminar estudiantes.");
}

if (!isset($_GET['idClase']) || !isset($_GET['idUser'])) {
    die("Parámetros inválidos.");
}

$idClase = intval($_GET['idClase']);
$idUser  = intval($_GET['idUser']);

// Borrar del registro de la clase
$sql = "DELETE FROM clases_has_cuenta WHERE CLASES_ID=? AND CUENTA_User=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $idClase, $idUser);

if ($stmt->execute()) {
    header("Location: classma.php?ID=$idClase");
    exit();
} else {
    echo "Error al eliminar estudiante: " . $stmt->error;
}
$stmt->close();
$conn->close();
