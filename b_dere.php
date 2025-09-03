<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
a{
    text-decoration: none;
}
.bo{
    grid-area: de;
}
.cale, .titulo_acceso_online,.barra_redes{
        background-color: #35403E;
        color: white;
        margin-bottom: 20px;
        padding-top: 10px;
        display: flex;
        justify-content: space-around;
        height: 30px;
    }
    .cal_img{
        height: 120px;
        width: 250px;
    }
    .tj{
        display: flex;
        justify-content: center;
    }
    .ingreso{
        background-color: gray;
        color: white;
        padding: 10px 20px 10px 20px ;
    } 

    .caja_comentario{
        border:solid 1px gray ;
        padding :10px ;
        border-radius: 10px;
    }
    .seh{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .bet ,.datos_profe{
        border: 0px solid; 
        background-color: transparent;
    }
    .comen{
        font-size: 20px;
    }
    .ty{
        display: flex;
        align-items: center;
    }
    .caja_comentario_2{
        padding: 5px;
        margin: 6px;
        border: 1px solid gray ;
        background-color: white;
        border-radius: 10px;
    }
    .respuesta{
  font-family: 'Questrial', sans-serif;
    }

    .scro{
    max-height: 400px;     /* Ajusta según lo que necesites */
    overflow-y: auto;      /* Barra lateral para deslizar */
    padding: 10px;
    border-radius: 10px; 
    background-color: #35403E;
    }

    </style>
</head>
<body class="bo">
<div class="barra_acceso">
            <h2 class="titulo_acceso_online">Acceso Online</h2>
            <div class="tj">
<?php       if (isset($_SESSION["ci"])) {
                if($_SESSION['rol']==3){
?>
                    <a class="ingreso" href="CuentasAdmin.php">Administracion</a>
<?php                            
                }else{
?>
                    <a class="ingreso" href="InicioES.php">Tus Clases</a>
<?php           }?>
<?php       }else{
?>
                <a class="ingreso" href="FormSession.php">Ingresa</a>
<?php       }
?>      
            </div>
        </div>
            <h2 class="cale">Calendario
            </h2>
        <div class="tj">
            <img class="cal_img" src="FOTOS/calendario.jpg">
        </div>
        <div >
            <h2 class="barra_redes">Comentarios</h2>
            <div >
            <section id="dos">
  
<?php
include("comentarios.php");
?>
</body>
</html>       
       
       
