<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    session_start();
   $usuario= $_GET['user'];
     $clave=$_GET['contra'];
  
    $conexion=mysqli_connect("localhost","root","","proyectoSISI");
    if (!$conexion) {
        echo "Error al conectar a la base de datos".mysqli_error();
        die();
    }
  
    $sql = "SELECT * 
        FROM CUENTA 
        INNER JOIN INFORMACION ON CUENTA.User = INFORMACION.CI 
        WHERE CUENTA.User='$usuario' AND CUENTA.Contrasena='$clave'";


    $resultado=mysqli_query($conexion,$sql);

    if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
        $fila=mysqli_fetch_assoc($resultado);

        $_SESSION['nombre']=$fila['Nombres'];
        $_SESSION['apellidos']=$fila['Apellidos'];
        $_SESSION['fechaNacimiento']=$fila['FechaNacimiento'];
        $_SESSION['telefono']=$fila['Telefono'];
        $_SESSION['curso']=$fila['Curso'];
        $_SESSION['direccion']=$fila['Direccion'];
        $_SESSION['ci']=$fila['CI'];
        $_SESSION['rude']=$fila['RUDE'];
        $_SESSION['rol']=$fila['Rol'];

        if($_SESSION['rol']==1)
            header("Location:inicioES.php");
        if($_SESSION['rol']==2)
            header("Location: inicioPR.php");
        if($_SESSION['rol']==3)
        header("Location: CuentasAdmin.php");
     }
  
     else{
         echo"Usuario no registrado vuelva a intentar";
         header("Location:FormSession.php");
    }
    

    ?>

</body>
</html>