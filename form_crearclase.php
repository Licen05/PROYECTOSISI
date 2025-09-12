<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForwardSoft</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

    <link rel="stylesheet" href="CSS/form_crearclase.css">
</head>
<body class="bod">
    <?php
session_start();
if (!isset($_SESSION['ci'])){ 
    header("Location:FormSession.php");
}

?>

<div class="todo">
        <div class="she"> 
                <div class="formulario">
                    <div class="marg">
                                <div class="uno">   
                                <a href="inicioPR.php"> <img class ="out" src="FOTOS/au.png"></a>
                                </div>

                                <div class="dos">
                                    <h2 class="titulo">CREA UNA CLASE</h2>

                                    <div class="centro">

                                        <form action="datos_clase.php" method="post" class="campos" id="formulario">
                                            <div class="preguntas">

                                                <div class="div1"> <label for="name">MATERIA:</label><br>
                                                <input type="text" id="name" name="Mat" class="camp"/><br> 
                                                </div>
                                                                    
                                                <div class="div2"><label for="grado">GRADO:</label><br>
                                                <input type="text" id="grado" name="Gra" class="camp"/><br> 
                                                </div>

                                                <div class="div3"><label for="codi" >CÓDIGO DE CLASE:</label><br>
                                                <input type="text" id="codi" name="clase" class="camp"/><br> 
                                                </div>  

                                                <div class="crear" style="position: relative"><button type="submit" class="but">CREAR</button></div>
                                                
                                            </div>
                                        </form>

                                    </div>
                                </div>

                    </div>
                </div>
        </div>  
</div>

<footer class="fo">
<?php include("footer.php"); ?>  
</footer> 

       
    <script>
        $(document).ready(function(){
            $("#formulario").validate({

                rules:{
                    Mat:{ required:true, minlength:4},
                    Gra:{ required:true, minlength:4},
                    clase:{ required:true, minlength:6, maxlength: 6}
                },
                messages:{
            Mat: {
                required: "Por favor, ingresa la materia",
                minlength: "Debe tener al menos 4 caracteres"
            },
            Gra: {
                required: "Por favor, ingresa el grado",
                minlength: "Debe tener al menos 4 caracteres"
            },
            clase: {
                required: "Por favor, ingresa el código de clase",
                minlength: "Debe tener exactamente 6 caracteres",
                maxlength: "Debe tener exactamente 6 caracteres"
            }
                }
            
        });
    });
    </script>
</body>
</html>