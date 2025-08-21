<?php
$servername = "localhost";
$username = "root";
$password="";
$dbname="proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexion fallida: ". $conn->connect_error);
}


session_start();
if (!isset($_SESSION['rol'])) {
    die("No tienes acceso");
}



$titulo = $_POST['titulo'];
$tema = $_POST['tema'];
$descripcion = $_POST['descript'];
$fechaET = $_POST['fechE'];

$sql= "INSERT INTO TAREA (Titulo, Tema, Descripcion, FechaEntrega, CLASES_ID) VALUES ('$titulo', '$tema', '$descripcion','$fechaET','$last_id')";
if ($conn->query($sql)=== TRUE) {
        $_SESSION['tituloT']=$titulo;
        $_SESSION['fechaET']=$fechaET;
        $last_id=$conn->insert_id;
        if ($_SESSION['rol'] == 1)
        header("Location: tablon_tareas.php?ID=$last_id");
    else if ($_SESSION['rol'] == 2)
        header("Location: tablon_tareasProf.php?ID=$last_id");
    exit();
} else{
    echo "Error: ". $sql ."<br>". $conn->error;
}


    $conn->close();
?>
