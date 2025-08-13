<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>

  <link href="CSS/form_regis.css" rel="stylesheet" type="text/css" />
    <title>Document</title>
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
$CI=$_GET['ci'];
$sql = "SELECT * 
        FROM CUENTA 
        INNER JOIN INFORMACION ON CUENTA.User = INFORMACION.CI 
        WHERE CUENTA.User='$CI' AND INFORMACION.CI='$CI'";

$resultado= $conn->query($sql);
if ($resultado->num_rows > 0) {
    while($fila=$resultado->fetch_assoc()){
        $Nombres = $fila['Nombres'];
        $Apellidos = $fila['Apellidos'];
        $Contrasena = $fila['Contrasena'];
        $Telefono = $fila['Telefono'];
        $Curso = $fila['Curso'];
        $Direccion = $fila['Direccion'];
        $CI = $fila['CI'];
        $RUDE = $fila['RUDE'];
        $FechaNacimiento = $fila['FechaNacimiento'];

    }

}

    ?>
  <script src="script.js"></script> 
 
  <header class="hea">
       <?php include("encabezado.php"); ?>
  </header>

  <div class="cuerpo">
  
  <?php include("barra_iz.php"); ?>

  <section class="centro">

            <div class="espacios">

    <form action="RegistroEdit.php" method="post" id="form_registro"><h1 id="t_registro">EDITA TUS DATOS</h1>
                    <div id="label">
    <label for="" class="label_registro" >Nombres</label> <br>
    <input type="text" name="nom" value='<?=$Nombres?>'  class="registro_espacios"><br>
    <label for="" class="label_registro" >Apellidos</label> <br>
    <input type="text" name="ape" value='<?=$Apellidos?>'  class="registro_espacios"><br>
    <label for="" class="label_registro" >Contraseña</label> <br>
    <input type="password" name="contra" value='<?=$Contrasena?>'  class="registro_espacios"><br>
    <label for="" class="label_registro" >Fecha de Nacimiento</label><br>
    <input type="date" name="fecha" value='<?=$FechaNacimiento?>'  class="registro_espacios"><br>
           <div class="row"> 
    <label for="" class="label_registro" >Curso</label><br>
    <input type="text" name="curso" value='<?=$Curso?>' class="registro_espacios"><br>
    </div>
    <label for="" class="label_registro" >Telefono</label><br>
    <input type="text" name="telef" value='<?=$Telefono?>' class="registro_espacios"><br>
    <label for="" class="label_registro" >Direccion</label><br>
    <input type="text" name="dire" value='<?=$Direccion?>' class="registro_espacios"><br>
  
    
    <input type="hidden" name="CI" value='<?=$CI?>'><br>
    
         <div id="botones">  
    <input type="submit" name="enviar" id="form_enviar" class="form_botones">

             </div>  

         </div>
    </div> 

  </section>
    </form>
  <section class="b_derecha"> </section>
</form>
  </div>
   <?php
    include("footer.php");
    ?>


    <script>
        $("form").validate({
        rules:{
            nom:{
                required:true, minlength:3,maxlength:30
            },
            ape:{
                required:true,minlength:3,maxlength:30
            },
            contra:{
                required:true,minlength:5,maxlength:10
            },
            curso:{
                required:true,minlength:3,maxlength:10
            },
            telef:{
                required:true,number:true;
            },
            dire:{
                required:true,minlength:5,maxlength:50
            },
            fecha:{
                required:true,minlength:5,maxlength:50
            },
            
        },
        messages:{
            nom:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de letras es 3",
                maxlength:"El maximo de letras es 30"
            },
            ape:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de letras es 3",
                maxlength:"El maximo de letras es 30"
            },
            contra:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de caracteres es 5",
                maxlength:"El maximo de caracteres es 10"
            },
            fecha:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de caracteres es 3",
                maxlength:"El maximo de caracteres es 10"
            },
            telef:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de caracteres es 5",
                maxlength:"El maximo de caracteres es 30"
            },
            dire:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de caracteres es 5",
                maxlength:"El maximo de caracteres es 50"
                
            },
            curso:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de caracteres es 5",
                maxlength:"El maximo de caracteres es 50"
                
            },
            CI:{
                required:"Este campo tiene que ser llenado",
                number:"Eso no es un numero"
               
            },
            
        },

       });
    </script>
</body>
</html>
