<?php

session_start(); // 🔥 importante, recupera el CI de la sesión activa

$servername = "localhost";
$username = "root";
$password="";
$dbname="proyectoSISI";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexion fallida: ". $conn->connect_error);
}




$ci = $_SESSION['ci'];
$idT = intval($_POST["idt"]);
$comentario = trim($_POST['comentario']);

// Recuperar nombre del usuario
$sqlUser = "SELECT Nombres, Apellidos FROM INFORMACION WHERE CI = ?";
$stmtUser = $conn->prepare($sqlUser);
$stmtUser->bind_param("s", $ci);

$stmtUser->execute();
$resUser = $stmtUser->get_result();
if ($resUser->num_rows > 0) {
    $row = $resUser->fetch_assoc();
    $nombre = $row['Nombres'] . " " . $row['Apellidos'];
} else {
    $nombre = "Desconocido";
}
$stmtUser->close();

 
$sql = "INSERT INTO COMENTARIO (Comentario, ID_tarea, usuario, Fecha) VALUES (?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sis", $comentario, $idT, $nombre);

if ($stmt->execute()) {
    // Recuperar ID de la clase para redirigir bien
    $sqlClase = "SELECT CLASES_ID FROM TAREA WHERE id = ?";
    $st = $conn->prepare($sqlClase);
    $st->bind_param("i", $idT);
    $st->execute();
    $res = $st->get_result();
    $idClase = 0;
    if ($res && $res->num_rows > 0) {
        $fila = $res->fetch_assoc();
        $idClase = $fila['CLASES_ID'];
    }

    header("Location: tarea.php?ID=$idClase&idT=$idT");
    exit();
} else {
    echo "Error al guardar el comentario: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>