<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

 
    <link rel="stylesheet" href="sweetalert2.min.css">
    <title>Document</title>
</head>
<body>
<?php
  
    include("bd.php");
   $usuario= $_GET['user'];
     $clave=$_GET['contra'];
  
  
    $sql = "SELECT * 
        FROM CUENTA 
        INNER JOIN INFORMACION ON CUENTA.User = INFORMACION.CI 
        WHERE CUENTA.User= ? AND CUENTA.Contrasena=?";
        
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ss",$usuario,$clave);
        $stmt->execute();
        $resultado=$stmt->get_result();

    if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
        $fila=mysqli_fetch_assoc($resultado);
        $_SESSION['bloqueado']=$fila['Bloqueado'];
        if($_SESSION['bloqueado']==1){
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 1000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: 'error',
  title: 'tu cuenta esta bloqueada'
});

setTimeout(function(){
  window.location.href = 'cerrar.php';
}, 1000);
</script>
";
        }

        $_SESSION['nombre']=$fila['Nombres'];
        $_SESSION['apellidos']=$fila['Apellidos'];
        $_SESSION['fechaNacimiento']=$fila['FechaNacimiento'];
        $_SESSION['telefono']=$fila['Telefono'];
        $_SESSION['curso']=$fila['Curso']; 
        $_SESSION['direccion']=$fila['Direccion'];
        $_SESSION['ci']=$fila['CI'];
        $_SESSION['rude']=$fila['RUDE'];
        $_SESSION['rol']=$fila['Rol'];
        
        if($_SESSION['rol']==1){
          
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
<script>
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 1000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: 'success',
  title: 'Bienvenido, has iniciado sesión'
});

setTimeout(function(){
  window.location.href = 'inicioES.php';
}, 1000);
</script>
";}

        if($_SESSION['rol']==2){
            //header("Location: inicioPR.php");
        }
        if($_SESSION['rol']==3)
           { //header("Location: CuentasAdmin.php");
            }
    }

  
     else{
         echo"Usuario no registrado vuelva a intentar";
         //header("Location:FormSession.php");
    }
    

    ?>

</body>
</html>