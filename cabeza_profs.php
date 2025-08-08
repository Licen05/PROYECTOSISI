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
    grid-template-columns: 15% 85%; 
    grid-template-rows: 150px 1300px;
    grid-template-areas:
    "he he"
    "ba cu"
    "fo fo" ;
}
.barra_sup{
    grid-area: he;
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
@media (max-width:900px){
  
.barra_sup{
font-size: 20px;
}
    }

.logo{
    height: 100px;
    border-radius: 50%;
}
.casa{
    height: 30px;
    margin: 0px -50px;
}
.pedro{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.titulo{
    padding-left: 25px;
    display: flex;
    font-size: 2em;
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
                                <a href="contact.php">Contactanos</a>
                                <a href="ajustes.php">Ajustes</a>
                                <a href="inicioPR.php">Clases creadas</a>
                            </div>
                        </div>
                </nav>
</body>
</html>