<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <title>Document</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Graduate&family=Questrial&display=swap');
    *{
        font-family: 'Graduate', serif;
    }
  </style>
</head>
<body>
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

    $sql2="INSERT INTO CLASES_HAS_CUENTA(CLASES_ID,CUENTA_User) VALUES ('$idClase','$Estudiante')";
    if ($conn->query($sql2)=== TRUE) {
        echo "
        <script>
        Swal.fire({
          icon: 'success',
          title: 'Te uniste a la clase correctamente',
          showConfirmButton: false,
          timer: 2000
        });
        setTimeout(function(){
          window.location.href = 'clases.php?ID=$idClase';
        }, 2000);
        </script>
        ";
    } else {
        echo "
        <script>
        Swal.fire({
          icon: 'error',
          title: 'No se pudo unir a la clase',
          text: 'Intenta de nuevo',
          timer: 2000,
          showConfirmButton: false
        });
        setTimeout(function(){
          window.location.href = 'form_unirme.php';
        }, 2000);
        </script>
        ";
    }

} else {
    echo "
    <script>
    Swal.fire({
      icon: 'error',
      title: 'Código incorrecto',
      text: 'Intenta de nuevo, por favor.',
      timer: 1500,
      showConfirmButton: false
    });
    setTimeout(function(){
      window.location.href = 'form_unirme.php';
    }, 1500);
    </script>
    ";
}
