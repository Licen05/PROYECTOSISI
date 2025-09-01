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
$id=$_SESSION['ci'];
              $sql= "SELECT * FROM  CLASES WHERE Profesor=$id";
              $resultado=mysqli_query($conn,$sql);
              if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                  while($fila=mysqli_fetch_assoc($resultado)){
                    
                    $titulo=$fila['Materia'];
                    $curso=$fila['Grado'];
                    $ID_Clase = $fila["ID"];
                  }}



$titulo = $_POST['titulo'];
$tema = !empty($_POST['tema_existente']) ? $_POST['tema_existente'] : $_POST['tema_nuevo'];
$descripcion = $_POST['descript'];
$fechaET = $_POST['fechE'];
$sobre = $_POST['sobre'];
$archivo = $_FILES['archivo'];

$sql= "INSERT INTO TAREA ( Titulo, Tema, Descripcion, FechaEntrega, CLASES_ID, Sobre, Archivo) VALUES ('$titulo', '$tema', '$descripcion','$fechaET','$ID_Clase','$sobre','$archivo')";
if ($conn->query($sql)=== TRUE) {
        $_SESSION['tituloT']=$titulo;
        $_SESSION['fechaET']=$fechaET;
        $_SESSION['tarea']=$archivo;
        $_SESSION['IDT']=$fila['id'];
        $last_id=$conn->insert_id;
        if ($_SESSION['rol'] == 1)
        header("Location: tablon_tareas.php?ID=$ID_Clase");
    else if ($_SESSION['rol'] == 2)
        header("Location: tablon_tareasProf.php?ID=$ID_Clase");
    exit();
} else{
    echo "Error: ". $sql ."<br>". $conn->error;
}


    $conn->close();
?>
