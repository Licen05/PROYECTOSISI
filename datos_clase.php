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
$Profesor = $_SESSION['ci'];
$Materia = $_POST['Mat'];
$Grado = $_POST['Gra'];
$Codigo = $_POST['clase'];

$sql= "INSERT INTO CLASES (Materia, Grado, Codigo, Profesor) VALUES ('$Materia', '$Grado', '$Codigo','$Profesor')";
if ($conn->query($sql)=== TRUE) {
        $_SESSION['titulo']=$Materia;
        $_SESSION['curso']=$Grado;
        $last_id=$conn->insert_id;
      // $imagen="logo_'$last_id'";
        header("Location: clases_pr.php?ID=$last_id");
}else{
    echo "Error: ". $sql ."<br>". $conn->error;
}

/*
$sql1= "SELECT * FROM  CLASES (Materia, Grado, Codigo, Profesor) VALUES ('$Materia', '$Grado', '$Codigo','$Profesor')";
$resultado=mysqli_query($conn,$sql);

    if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
        $fila=mysqli_fetch_assoc($resultado);

        $_SESSION['titulo']=$fila['Materia'];
        $_SESSION['curso']=$fila['Grado'];
        $last_id=$conn->insert_id;

    }
*/

    $conn->close();
?>
