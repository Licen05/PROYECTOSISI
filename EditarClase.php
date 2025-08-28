<?php
$servername = "localhost";
$username = "root";
$password="";
$dbname="proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexion fallida: ". $conn->connect_error);
}
$Materia = $_POST['Mat'];
$Grado = $_POST['Gra'];
$ID_Clase = $_POST['ID'];


$sql="UPDATE CLASES SET Materia='$Materia',Grado='$Grado' WHERE ID='$ID_Clase' ";


if ($conn->query($sql)===TRUE && $conn->query($sql)===TRUE){
    header("Location:inicioPR.php?");
}
?>