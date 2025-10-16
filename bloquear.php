<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$CI_b=$_GET['CI'];

$sql ="UPDATE CUENTA SET Bloqueado = TRUE WHERE User = '$CI_b'";
if ($conn ->query("$sql") === TRUE) {
    header("Location:admin.php");
    exit();

}else{
    echo "Error D:". $conn->error;
}
 
/*
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Ejemplo: bloquear cuenta con id=5
$idCuenta = 5; // <- Este es el usuario que quieres bloquear/desbloquear

// Para bloquear (poner en 1 / TRUE)
$sql = "UPDATE CUENTS SET Bloqueado = TRUE WHERE id = $idCuenta";

// Para desbloquear (poner en 0 / FALSE)
// $sql = "UPDATE CUENTS SET Bloqueado = FALSE WHERE id = $idCuenta";

if ($conn->query($sql) === TRUE) {
    echo "Cuenta actualizada correctamente";
} else {
    echo "Error al actualizar: " . $conn->error;
}

$conn->close();

header("Location:CuentasAdmin.php");
exit;*/
?>

