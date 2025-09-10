<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> <!-- Define la codificación de caracteres como UTF-8 -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Hace que el sitio sea responsive -->
    <title>Document</title>
    <style>
/* Estilo para enlaces: se eliminan los subrayados */
a{
    text-decoration: none;
}

/* Clase aplicada al body para definir su área de grid */
.bo{
    grid-area: de;
}
/* Estilos comunes para calendario, título de acceso online y barra de redes */
.cale, .titulo_acceso_online,.barra_redes{
    background-color: #35403E; /* Color de fondo */
    color: white;              /* Texto en blanco */
    margin-bottom: 20px;       /* Separación inferior */
    padding-top: 10px;         /* Espacio arriba */
    display: flex;             /* Se usa flexbox */
    justify-content: space-around; /* Distribuye elementos con espacio alrededor */
    height: 30px;              /* Altura fija */
}

/* Imagen del calendario */
.cal_img{
    height: 120px;
    width: 250px;
}

/* Clase para centrar contenido en horizontal con flex */
.tj{
    display: flex;
    justify-content: center;
}

/* Estilos del botón de ingreso */
.ingreso{
    background-color: gray;
    color: white;
    padding: 10px 20px 10px 20px ; /* Espaciado interno */
} 

/* Caja para comentarios */
.caja_comentario{
    border:solid 1px gray ;
    padding :10px ;
    border-radius: 10px; /* Bordes redondeados */
}

/* Distribuye elementos de forma separada y alineados al centro */
.seh{
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Botones sin borde ni fondo (transparentes) */
.bet ,.datos_profe{
    border: 0px solid; 
    background-color: transparent;
}

/* Texto de comentarios con fuente más grande */
.comen{
    font-size: 20px;
}

/* Alinea elementos en el centro vertical */
.ty{
    display: flex;
    align-items: center;
}

/* Caja de comentarios secundarios */
.caja_comentario_2{
    padding: 5px;
    margin: 6px;
    border: 1px solid gray ;
    background-color: white;
    border-radius: 10px;
}

/* Estilo para respuestas */
.respuesta{
    font-family: 'Questrial', sans-serif;
}

/* Caja con scroll vertical */
.scro{
    max-height: 400px;     /* Altura máxima */
    overflow-y: auto;      /* Muestra scroll si hay exceso */
    padding: 10px;
    border-radius: 10px; 
    background-color: #35403E;
}
.hola{
    display: flex;
    flex-direction: column;
    gap:-5px;
}

.ingreso{
    text-align: center;
}
/* Media query: si la pantalla es menor a 1200px, cambia el fondo */
@media (max-width: 1200px) {
    .tj{
   
    }
}
    </style>
</head>
<body class="bo"> <!-- Aplica clase bo al body -->
<div class="barra_acceso">
    <h2 class="titulo_acceso_online">Acceso Online</h2>
    <div class="tj">
<?php   
    // Verifica si existe una sesión iniciada
    if (isset($_SESSION["ci"])) {
        // Si el rol es 3, muestra acceso a administración
        if($_SESSION['rol']==3){
?>
<div class="hola">
            <a class="ingreso" href="CuentasAdmin.php">Administracion</a>
            <br>
            <a class="ingreso" href="cerrar.php">Cerrar Sesion</a>
         </div> 
<?php                          
        }else{ 
            // Caso contrario, muestra acceso a clases
?>
<div class="hola">
            <a class="ingreso" href="InicioES.php">Tus Clases</a>
            <br>
            <a class="ingreso" href="cerrar.php">Cerrar Sesion</a>
            </div>
<?php   
        } // Cierre del else
?>
<?php   
    }else{ 
        // Si no hay sesión, muestra opción para ingresar
?>
        <a class="ingreso" href="FormSession.php">Ingresa</a>
<?php   
    } // Cierre del else
?>      
    </div>
</div>

<!-- Sección calendario -->
<h2 class="cale">Calendario</h2>
<div class="tj">
    <img class="cal_img" src="FOTOS/calendario.jpg"> <!-- Imagen del calendario -->
</div>

<!-- Sección comentarios -->
<div>
    <h2 class="barra_redes">Comentarios</h2>
    <div>
        <section id="dos">
<?php
    // Se incluye archivo PHP que contiene el manejo de comentarios
    include("comentarios.php");
?>
</body>
</html>       
