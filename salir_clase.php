<?php
session_start();
$archivo = 'mensajes.txt';
$archivo_respuestas = 'respuestas.txt';

// Conexión a la base de datos 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

    date_default_timezone_set('America/La_Paz'); 

    /*
if (!isset($_SESSION["id"])){
    header("location:inicio.php");
}*/

if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

$idUsuario = $_SESSION['ci'];
$idClase   = isset($_POST['idClase']) ? intval($_POST['idClase']) : 0;

if ($idClase > 0) {
    // Eliminar relación de estudiante con clase
    $sql = "DELETE FROM CLASES_HAS_CUENTA WHERE CLASES_ID = ? AND CUENTA_User = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $idClase, $idUsuario);

    if ($stmt->execute()) {
        header("Location: inicioES.php?msg=salida_ok");
        exit();
    } else {
       header("Location: inicioES.php?msg=error_sql");
        exit();
    }
    $stmt->close();
} else {
    header("Location: inicioES.php?msg=clase_invalida");
    exit();
}

$conn->close();
?>
