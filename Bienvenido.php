<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Alumno</title>
  <link href="CSS/bienvenidoProfs.css" rel="stylesheet" type="text/css" />
  <style>
    .bienvenida{
      margin-top:450px;
    }
    </style> 
 
</head>

<<<<<<< Updated upstream
<body>

  <header>

        
                     <?php
    include("encabezado.php");
    ?>
                   
            <script>
              function toggleMenu() {
  const dropdown = document.getElementById("menu_desple");
  dropdown.classList.toggle("activo");
}
            
</script>
  </header> 
=======
<body class="bo">
<?php
session_start();
?>
<header class="hea">
   <?php include("encabezado.php"); ?>
</header> 
>>>>>>> Stashed changes
  <div class="cuerpo">
  <section class="b_izquierda">
    <?php include("barra_iz.php"); ?>
  </section>
  <section class="centro">
    <div class="bienvenida"> 
        <div class="texto">
            ¡Bienvenido, alumno! 
        <div class="texto2" >En este espacio, <br> usted encontrará sus datos: </div>
        </div>
                <img src="FOTOS/caracter.jpg" class="foto_estu">
        </div>
        <h1 class="titulo_datos"  > DATOS PERSONALES </h1>
       
            <table class="tabla_estu">
                <tr>
                    <th class="th_estu"> Nombres:</th>
                
                    <td class="td_estu"> <?= $_SESSION['nombre']?>  </td>
                </tr>
                 <tr>
                    <th class="th_estu">Apellidos:</th>
                    <td class="td_estu">  <?= $_SESSION['apellidos']?>  </td>
                </tr>
                 <tr>
                    <th class="th_estu">Curso:</th>
                    <td class="td_estu"> <?= $_SESSION['curso']?>  </td>
                </tr>
                 <tr>
                    <th class="th_estu">Fecha de Nacimiento:</th>
                    <td class="td_estu">  <?= $_SESSION['fechaNacimiento']?> </td>
                </tr>
                 <tr>
                    <th class="th_estu">Dirección:</th>
                    <td class="td_estu">  <?= $_SESSION['direccion']?> </td>
                </tr>
                 <tr>
                    <th class="th_estu">Célula de indentidad:</th>
                    <td class="td_estu"> <?= $_SESSION['ci']?> </td>
                </tr>
                 <tr>
                    <th class="th_estu">RUDE:</th>
                    <td class="td_estu"> <?= $_SESSION['rude']?> </td>
                </tr>
                <tr>
                    <th class="th_estu">Telefono:</th>
                    <td class="td_estu">  <?= $_SESSION['telefono']?></td>
                </tr>

            </table>
            <div class="botones_f">
                
               <?= 
                "<a href='cerrar.php'><button class= 'boto'>cerrar sesion</button></a>";
                 $ci=$_SESSION['ci'];
                 echo "<a href='FormEdit.php?ci=$ci'><button class= 'boto'>Editar</button> </a> "; 
                ?>
                </div>
                
  </section>
  <section class="b_derecha"> </section>
  </div>
<<<<<<< Updated upstream
   <?php
    include("footer.php");
    ?>
=======
    <footer>  <?php include("footer.php"); ?> </footer>
>>>>>>> Stashed changes
</body>

</html>