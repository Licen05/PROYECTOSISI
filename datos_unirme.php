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
$Estudiante = $_SESSION['ci'];
$Cod_clase = $_POST['codi'];

$sql="SELECT * FROM CLASES WHERE Codigo='$Cod_clase'";
$resultado=mysqli_query($conn,$sql);
if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
    $fila=mysqli_fetch_assoc($resultado);
    $idClase=$fila['ID'];
}
else{
    header("Location: form_unirme.php?msg=codigo_invalido");
    exit();
}
$sql2="INSERT INTO CLASES_HAS_CUENTA(CLASES_ID,CUENTA_User) VALUES ('$idClase','$Estudiante')";
if ($conn->query($sql2)=== TRUE) {
             header("Location: inicioES.php?msg=union_ok");
    exit();
} else {
    header("Location: form_unirme.php?msg=union_error");
    exit();

}

/*
$sql= "INSERT INTO CLASES (Materia, Grado, Codigo, Profesor) VALUES ('$Materia', '$Grado', '$Codigo','$Profesor')";
if ($conn->query($sql)=== TRUE) {
        $_SESSION['titulo']=$Materia;
        $_SESSION['curso']=$Grado;
        $last_id=$conn->insert_id;
        header("Location: clases_pr.php?id='$last_id'");
}else{
    echo "Error: ". $sql ."<br>". $conn->error;

}*/
    $conn->close();
?>
