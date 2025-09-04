<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
  <title>Iniciar Sesión</title>
  <link href="CSS/FormSession.css" rel="stylesheet" type="text/css" />
  <style>
    a{
      text-decoration:none;
    }
  </style>
  
</head>
<body class="bo">
<header class="hea">
<?php include("encabezado.php"); ?>
</header>

<div class="cuerpo">
<section class="b_izquierda">
<?php include("barra_iz.php"); ?>
</section>

<section class="centro">
    
<div class="espacios">
    <form action="datos2.php" method="GET">
    <fieldset>
      <h1>Iniciar Sesión</h1>

      <div class="usu">
        <img src="FOTOS/usu.jpg" alt="Usuario" width="50px" height="50px">
        <input type="number" name="user" placeholder="Nombre de usuario">
      </div>

      <div class="usu">
        <img src="FOTOS/contra.jpg" alt="Contraseña">
        <input type="password" name="contra" placeholder="Password" >
      </div>


      <div class="a">
        <input class="en" type="submit" value="Entrar" >
        <input class="en" type="reset" value="Borrar" >
      </div>
 
      
      <p class="victoria">¿No tienes una cuenta? <a href="Form_regis.php">Regístrate aquí</a></p>
      </fieldset>
</form>     
</section>
</div> 
<footer>
 <?php include("footer.php"); ?>
</footer>
</body>
<script>
      $("form").validate({
        rules:{
            nom:{
                required:true, minlength:3,maxlength:15
            },
            contra:{
                required:true,minlength:3,maxlength:10
            }

        },
        messages:{
            nom:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de letras es 3",
                maxlength:"El maximo de letras es 15"
            },
            contra:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de caracteres es 3",
                maxlength:"El maximo de caracteres es 10"
            }
        },

       });

    </script>
</html>