<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForwardSoft</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    
    <link rel="stylesheet" href="CSS/form_unirme.css">
    <style>
   .pablo{
    padding: 20px;
   }   
    </style>
</head> 
<body class="bo"> 
<?php
session_start();
if (!isset($_SESSION['ci'])){
    header("Location:FormSession.php");
}
?> 
<div class="pablo">
    <div class="she">
        <div class="formulario"> 

          <div class="uno">  
          <a href="inicioES.php"><img class ="out" src="FOTOS/au.png"></a>
          </div>

          <div class="dos"> 
          <h2 class="titulo">ÚNETE A UNA CLASE</h2>
          </div>

          <div class="tres">

          <form action="datos_unirme.php" method="post" class="clase" id="formulario">
          <label for="name" class="sara">INGRESA EL CÓDIGO <br>DE CLASE:</label><br>
          <input type="text" name="codi" id="codigo" class="cod"/> <br>
          
          <div class="unir" style="position: relative">
          <button type ="submit" class="unirme">UNIRME</button>
          </div>
          </form>
      
          <div class="img">
            <img class ="ima" src="FOTOS/estu2.png">
          </div>
          </div>
        </div>
    </div>
</div> 

<footer>  
<?php include("footer.php"); ?> 
</footer>

<script>
   
$(document).ready(function(){
$("#formulario").validate({

rules:{
codi:{ required:true, minlength: 6, maxlength: 6}
},
messages:{
codi: {
required: "Por favor, ingresa el código de clase",
minlength: "Debe tener exactamente 6 caracteres",
maxlength: "Debe tener exactamente 6 caracteres"
            }
                },
                
        });
    });
    </script>

</body>
</html>