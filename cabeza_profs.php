<style>

.cuerpo{
    display: grid;
    grid-template-columns: 15% 85%; 
    grid-template-rows: auto minmax(1500px, auto) auto;
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
.pedro{ /* CABECERA */
    display: flex;
    flex-direction: row;
    align-items: center;
}
.tablon{
    grid-area: cu;
}
.logo{
    height: 140px;
    border-radius: 50%;
}
.casa{
    height: 40px;
}
.titulo{
    padding-left: 50px;
    display: flex;
    font-size: 3em;
}
/*barra ploma*/
.barra{
    grid-area: ba;
    background-color: GRAY;
    padding: 74px;
    display: flex;
    justify-content: center;
}
/*MENUU*/

 .menu {
display: flex;
display: inline-block;
height: 40px;

}

.menu-boton {
height: 40px;
font-size: 16px;
border: none;
cursor: pointer;
    }

.menu-contenido {
color: white;
display: none;
position: absolute;
background-color:rgb(31,35,46);
min-width: 160px;
box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
z-index: 1;
    }

.menu-contenido a {
color: rgb(255, 255, 255);
padding: 12px 16px;
text-decoration: none;
display: block;
    }

.menu-contenido a:hover {
background-color: #ffffff;
color: black;
    }

.mostrar {
display: block;
    }

@media (max-width: 900px){
  
.barra_sup{
font-size: 20px;
}
    }

</style>
   
<header> 
<div class ="barra_sup">
<div class="pedro"><img class ="logo" src="FOTOS/logo.jpeg"> <h2 class="titulo">U.E. RENÉ BARRIENTOS</h2>
</div> 
</div>
</header>
<div class="cuerpo">
    <nav class ="barra">
        <div class="menu">
            <img onclick="toggleMenu()" class="menu-boton" src="FOTOS/menu.png">
            <div id="dropdown" class="menu-contenido">
                <a href="inicio.php">Inicio</a>
                <a href="BienvenidoProfs.php">Datos Personales</a>
                <a href="contacto.php">Contactanos</a>
                <a href="ajustes.php">Ajustes</a>
                <a href="inicioES.php">Mis Clases</a>
            </div>
        </div>
    </nav>
