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

$sql ="UPDATE CUENTA SET Rol = 1 WHERE User = '$CI_b'";
if ($conn ->query("$sql") === TRUE) {
    header("Location:CuentasAdmin.php");
    exit();

}else{
    echo "Error D:". $conn->error;
}