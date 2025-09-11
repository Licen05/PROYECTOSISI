<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Alumno</title>
  <link href="CSS/encabezado.css" rel="stylesheet" type="text/css" />
  <link href="CSS/b_izquierda.css" rel="stylesheet" type="text/css" />
  <link href="CSS/bienvenidoProfs.css" rel="stylesheet" type="text/css" />

</head>
<?php
session_start();
?>
<body class="bo">

<header class="hea">
   <?php include("encabezado.php"); ?>
</header> 
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
  </div>
    <footer>  <?php include("footer.php"); ?> </footer>

</body>

</html>