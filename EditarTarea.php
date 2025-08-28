<?php
$servername = "localhost";
$username = "root";
$password="";
$dbname="proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexion fallida: ". $conn->connect_error);
}

// Validar que venga el id de la tarea por POST
if (!isset($_POST['idT']) || !is_numeric($_POST['idT'])) {
    die("ID de tarea no válido.");
}
$idt = intval($_POST['idT']);

// Recibir datos del formulario
$titulo = $_POST['tit'];
$tema = !empty($_POST['tema_existente']) ? $_POST['tema_existente'] : $_POST['tema_nuevo'];
$descripcion = $_POST['descript'];
$fechaET = $_POST['fechE'];
$sobre = $_POST['sobre'];

// Update
$sql = "UPDATE TAREA 
        SET Titulo = ?, Tema = ?, Descripcion = ?, FechaEntrega = ?, Sobre = ? 
        WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssii", $titulo, $tema, $descripcion, $fechaET, $sobre, $idt);
$id_ = $_POST['ID'] ; 
if ($stmt->execute()) {
    header("Location: tablon_tareasProf.php?ID=$id_");
    exit();
} else {
    echo "Error al actualizar la tarea: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
