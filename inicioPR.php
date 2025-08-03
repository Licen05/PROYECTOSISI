<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForwardSoft</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="CSS/inicioPR.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="CSS/cabeza.css">

</head> 
<body class="bo">

      <?php include("cabeza.php"); ?>
    
      <?php
        session_start();
        if (!isset($_SESSION['ci'])){
            header("Location:FormSession.php");
        }
        
        if($_SESSION['rol']==1)
            header("Location:inicioES.php");

        $servername = "localhost";
        $username = "root";
        $password="";
        $dbname="proyectoSISI";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Conexion fallida: ". $conn->connect_error);
        }
?>
    
 <div class="cuerpo">

                <nav class ="barra">
                    <div class="menu">
                        <img onclick="toggleMenu()" class="menu-boton" src="FOTOS/menu.png">
                            <div id="dropdown" class="menu-contenido">
                                <a href="inicio.php">Inicio</a>
                                <a href="Bienvenido.php">Datos Personales</a>
                                <a href="#">Contactanos</a>
                                <a href="#">Ajustes</a>
                                <a href="inicioPR.php">Clases creadas</a>
                            </div>
                    </div>
                </nav>

  
<nav class ="tablon">
            
            <?php
              $id=$_SESSION['ci'];
              $sql= "SELECT * FROM  CLASES WHERE Profesor=$id";
              $resultado=mysqli_query($conn,$sql);
              if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                  while($fila=mysqli_fetch_assoc($resultado)){
                    
                    $titulo=$fila['Materia'];
                    $curso=$fila['Grado'];
                    $ID_Clase = $fila["ID"];
                 
?>

<div class="ger">
            <h3 class="nam"><?=$titulo?></h3>
            <h4 class="cat"><?=$curso?></h4>
            <div class="editar"> <a href='clases_pr.php?ID=<?=$ID_Clase?>'><img src="FOTOS/ing.png" width="40px" ></img> </a> </div>
            <div class="editar"> <a href='formEditClase.php?ID=<?=$ID_Clase?>'><img src="FOTOS/edit.png" width="40px" ></img> </a> </div>
</div>
            
<?php }
    }else{
            ?>
            <nav class="ambos">
            <img class="conejo" src ="FOTOS/conejo.png">
            <h3 class="texto">TU TABLON ESTA VACIO</h3>
            
<?php
    }
    ?>
         
          <div class="ajo">
          <a class="boton_unir" href="form_crearclase.php">CREA A UNA CLASE</a>
          <a class="boton_unir" href="form_unirme.php">UNETE A UNA CLASE</a>
          </div>
            
            </nav>
        </nav>
    </div> 
    

<script>
    function toggleMenu() {
      document.getElementById("dropdown").classList.toggle("mostrar");
    }

    // Cerrar el menú si se hace clic fuera de él
    window.onclick = function(event) {
      if (!event.target.matches('.menu-boton')) {
        var dropdowns = document.getElementsByClassName("menu-contenido");
        for (var i = 0; i < dropdowns.length; i++) {
          var abierto = dropdowns[i];
          if (abierto.classList.contains('mostrar')) {
            abierto.classList.remove('mostrar');
          }
        }
      }
    }
  </script>

</body>
</html>