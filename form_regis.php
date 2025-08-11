<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Alumno</title>
  <link href="CSS/form_regis.css" rel="stylesheet" type="text/css" />
  
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
 
</head>

<body class="bo">
 
  <header class="hea">
        <div class="encabezado"> 
                    <img src="FOTOS/logo.jpeg" class ="logo_cole"/>
                    <a href="" class="titulo">U.E. RENÉ BARRIENTOS</a>
                </div>
            <div class="menu">
                    <button onclick="toggleMenu()" class="menu-boton"><img src="FOTOS/barras.png" style=" width: 50px "></button>
                    <div id="menu_desple" class="barra">
                    <ul class="botones">
                    <li><a href="" id="primero" class="inicio"><i></i>INICIO</a></li>
                    <li><a href="" class="bot"><i ></i>CONOCE EL COLEGIO</a></li>
                    <li><a href="" class="bot"><i ></i>SERVICIOS</a></li>
                    <li><a href="" class="bot"><i></i>SERVICIOS EN LÍNEA</a></li>
                    <li><a href="" class="bot"><i ></i>MISIÓN Y VISIÓN</a></li>
                    <li><a href="" class="bot"><i ></i>COMUNÍCANOS</a></li>
                    <li><a href="" class="bot"><i ></i>CONTÁCTANOS</a></li>
                    </ul>
                    </div>
                        <div class="buscador" >Buscar...</div>
                        <div class="vacio"></div>
                    </div>
            <script>
              function toggleMenu() {
  const dropdown = document.getElementById("menu_desple");
  dropdown.classList.toggle("activo");
}
            
</script>
  </header>
  <div class="cuerpo">

  

  <section class="centro">


        <div class="espacios">
    
         <form action="registro.php" method="post" id="form_registro"> <h1 id="t_registro">REGISTRO</h1>

            <div id="label">
        
         <label for=""  class="label_registro" > Nombre: </label> 
            <input type="text" name="nom" class="registro_espacios">
         <label for=""  class="label_registro" id="label_apellido"> Apellidos: </label> 
            <input type="text" name="ape" class="registro_espacios"> 
         <label for=""  class="label_registro"> Contraseña:  </label>
            <input type="password" name="contra" class="registro_espacios"> 
         <label for=""  class="label_registro"> Fecha de nacimiento: </label>
            <input type="date" name="fecha" class="registro_espacios">
    <div class="row">      
            <label for=""  class="label_registro2" > Curso: </label>
             <input type="text" name="curso"  class="registro_espacios2">
            <label for=""  class="label_registro2"> C.I.: </label> 
             <input type="number" name="CI" class="registro_espacios2">
    </div>
             <label for=""  class="label_registro"> RUDE: </label>
             <input type="number" name="RUDE" class="registro_espacios">
             <label for=""  class="label_registro"> Dirección: </label>  
             <input type="text" name="dire" class="registro_espacios">
             <label for=""  class="label_registro"> Teléfono: </label>
             <input type="text" name="telef" class="registro_espacios"> 

         <div id="botones">  
         <input type="reset" value="BORRAR" id="form_borrar" class="form_botones"> 
         <input type="submit" value="ENVIAR" id="form_enviar" class="form_botones"> 
         </div>  

         </div>
    </div> 

  </section>
  <section class="b_derecha"> </section>
</form>
  </div>
   <?php
    include("footer.php");
    ?>

    <script>
      
         $(document).ready(function(){
        $("#form_registro").validate({
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
            fecha:{
                required:true,minlength:5,maxlength:30
            },
            dire:{
                required:true,minlength:5,maxlength:50
            },
            CI:{
                required:true,number:true
            },
            RUDE:{
                required:true,number:true
            },
            telef:{
                required:true,number:true

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
            curso:{
                required:"Este campo tiene que ser llenado",
                 minlength:"El minimo de caracteres es 3",
                maxlength:"El maximo de caracteres es 10"
            },
            fecha:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de caracteres es 5",
                maxlength:"El maximo de caracteres es 30"
            },
            dire:{
                required:"Este campo tiene que ser llenado",
                minlength:"El minimo de caracteres es 5",
                maxlength:"El maximo de caracteres es 30"
                
            },
            CI:{
                required:"Este campo tiene que ser llenado",
                number:"Eso no es un numero"
               
            },
            RUDE:{
                required:"Este campo tiene que ser llenado",
                number:"Eso no es un numero"
               
            },
            telef:{
                required:"Este campo tiene que ser llenado",
                number:"Eso no es un numero"
        }

       }
    });
});
    </script>
</body>

</html>