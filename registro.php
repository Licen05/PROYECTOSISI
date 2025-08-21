<?php
$servername = "localhost";
$username = "root";
$password=""; 
$dbname="proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexion fallida: ". $conn->connect_error);
}
$Nombres = $_POST['nom'];
$Apellidos = $_POST['ape'];
$Contrasena = $_POST['contra'];
$Telefono = $_POST['telef'];
$Curso = $_POST['curso']; 
$Direccion = $_POST['dire'];
$CI = $_POST['CI'];
$RUDE = $_POST['RUDE'];
$FechaNacimiento = $_POST['fecha'];


$sql = "INSERT INTO INFORMACION (Nombres, Apellidos, FechaNacimiento, Telefono, Curso, Direccion, CI, RUDE) VALUES ('$Nombres','$Apellidos','$FechaNacimiento','$Telefono','$Curso','$Direccion','$CI','$RUDE')";
$sql1 = "INSERT INTO CUENTA ( User, Contrasena, Rol) VALUES ('$CI','$Contrasena',1)";
if ($conn->query($sql) && $conn->query($sql1) === TRUE) {
    echo "Nueva cuenta creado exitosamente";
    header("Location:FormSession.php");
  
}else{
    echo "Error: ". $sql ."<br>". $conn->error;
}
$conn->close();
?>