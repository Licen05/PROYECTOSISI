<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>

        /*barra blanca*/
.cuerpo{
    display: grid;
    grid-template-columns: 10% 90%; 
    grid-template-rows: 150px 1300px;
    grid-area:
    "he he"
    "ba cu" ;
}
.barra_sup{
    grid-area: "he";
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 50px 80px;
    flex-wrap: wrap;
    background-color: rgb(255, 255, 255);
    align-items: center;
}
.logo{
    height: 140px;
    border-radius: 50%;
}
.casa{
    height: 40px;
}
.pedro{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.titulo{
    padding-left: 50px;
    display: flex;
    font-size: 3em;
}

    </style>
</head>
<body>
    <header> 
        <div class ="barra_sup">
            <div class="pedro"><img class ="logo" src="FOTOS/logo.jpeg"> <h2 class="titulo">U.E. RENÉ BARRIENTOS</h2></div> 
            <img  class="casa" src="FOTOS/casa.png">
        </div>
    </header>
  <div class="cuerpo">
                <nav class ="barra">
                    <div class="menu">
                        <img onclick="toggleMenu()" class="menu-boton" src="FOTOS/menu.png">
                            <div id="dropdown" class="menu-contenido">
                                <a href="inicio.php">Inicio</a>
                                <a href="BienvenidoProfs.php">Datos Personales</a>
                                <a href="#">Contactanos</a>
                                <a href="#">Ajustes</a>
                                <a href="inicioPR.php">Clases creadas</a>
                            </div>
                        </div>
                </nav>
</body>
</html>