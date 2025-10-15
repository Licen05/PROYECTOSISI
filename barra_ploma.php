<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .barra{
            min-height: 800px;
        }
        .menu{
            display:flex;
            justify-content:center;
        }
        
.menu{
    height: 40px;
}

    </style>
</head>
<body>
    <div class="cuerpo">
<nav class ="barra">
        <div class="menu">
            <img onclick="toggleMenu()" class="menu-boton" src="FOTOS/menu.png" >
            <div id="dropdown" class="menu-contenido">
            <a href="inicio.php">Inicio</a>
            <a href="BienvenidoProfs.php">Datos Personales</a>
            <a href="contacto.php">Contactanos</a>
            <a href="inicioES.php">Mis Clases</a>
            </div>
        </div>
</nav>
</div>
</body>
</html>