<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Graduate&family=Questrial&display=swap');

body {
  font-family: 'Graduate', serif;
  margin: 0px;
   
}

header{
    grid-area: he;
    display: flex; 
    flex-direction: column;
    gap: 10px;
}

.encabezado{
    background-color: #35403E;
    display: flex;
    align-items: center;
    gap: 60px;
    padding: 60px;
}
.titulo{
    color: white;
    font-size: 50px;
    text-decoration: none;
}

/*MENU*/
.menu{
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 23px;
    margin: 0px;
    background-color: blue;

}
.botones{
    display: flex;
    align-items: center;
    flex-direction: row;
    gap: 50px;
    padding: 2px 0px 2px 0px;
    padding-right: 10px ;
    list-style: none;
    
    
}
.bot,.inicio{
    text-decoration: none;
    padding: 16px;
    border-radius: 30px;
    font-size: 20px;
    
}
.inicio{
    background-color: #35403E;
    margin-left: -35px;
    font-size: 13px;
    font-weight: 800;
    padding: 16px;
    color: white;
}
.bot{
    background-color: transparent;
    font-size: 13px;
    font-weight: 500;
    padding: 12px;
    border: none;
    color: white;
    outline: 2px solid white;
    position: relative;
    transition: 0.3s;
}

.bot:hover{
    outline: 2px solid #35403E;
    background-color: #ffffff;
    color:#35403E;
}

.bot:hover::after{
    transform: scale(1, 1);
}

.logo_cole{
    width:100px; 
    height:100px;
    border-radius: 50%;
}

.logo_cole{
    animation: t 0.6s ease;
}
@keyframes t {
    0% {transform: rotate(0deg);}
    100%{transform: rotate(360deg);}
}

.menu-boton {
  display: none;
  border: none;
  margin: 10px 20px;
  cursor: pointer;
  background-color: transparent;
}
 .ft{
    height: 50px;
 }
#dropdown {
  display: flex;
  
}


@media (max-width: 1910px) {

.inicio{
    margin-left: 3px;
  }
  .bot,.inicio{
    background-color: transparent;
    font-size: 13px;
    font-weight: 500;
    padding: 10px;
    border: none;
    color: white;
    outline: 2px solid white;
    position: relative;
    transition: 0.3s;
}

.bot:hover,.inicio:hover{
    outline: 2px solid #686c75;
    background-color: #ffffff;
    color: rgb(0, 0, 0);
}
.menu {
    flex-direction: column;

  }

.menu-boton {
    display: block;
    margin: 10px 0 10px 15px;
    z-index: 2;

  }

#menu_desple {
    display: none;
    flex-direction: column;
    background-color: transparent;
    z-index: 1;
  }

#menu_desple.activo {
    display: block;
  }

.botones {
    background-color: transparent;
    flex-direction: column;
    align-items: flex-start;
    gap: 35px;
  
  }

.buscador,.vacio {
    display: none;
  }

}

@media (max-width:790px) {
    body{
            margin: 0px;
            display: grid;
            grid-template-columns: 100%;
            grid-template-rows: 350px;
            grid-template-areas: 
            "he";
        
    }
      
}
a{
    text-decoration: none;
}

.menu{
    background-color: gray;
    display: flex;
    justify-content: center;
}
.botones{
    display: flex;
    flex-wrap: nowrap;
    justify-content: center; 
}
.barra{
    padding: 7px;
    margin: 3px;
}
.bot,.inicio{
    padding: 15px;
}


    </style> 
</head> 

    <header> 
        <div class="encabezado"> 
                    <img src="FOTOS/logo.jpeg" class ="logo_cole"/>
                    <a href="inicio.php" class="titulo">Unidad Educativa René Barrientos</a>
                </div>
            <div class="menu">
                    <button onclick="toggleMenu()" class="menu-boton"><img class="ft" src="FOTOS/barras2.png"></button>
                    <div id="menu_desple" class="barra">
                    <ul class="botones">
                    <li><a href="inicio.php" id="primero" class="inicio"><i></i>INICIO</a></li>
                    <li><a href="conoce.php" class="bot"><i ></i>CONOCE EL COLEGIO</a></li>
                    <li><a href="servicios.php" class="bot"><i ></i>SERVICIOS</a></li>
                    <li><a href="historia.php" class="bot"><i></i>HISTORIA</a></li>
                    <li><a href="datos_cole.php" class="bot"><i ></i>MISIÓN Y VISIÓN</a></li>
                    <li><a href="contacto.php" class="bot"><i ></i>CONTÁCTANOS</a></li>
                    </ul>
            </div>   
            <script>
              function toggleMenu() {
  const dropdown = document.getElementById("menu_desple");
  dropdown.classList.toggle("activo");
}
            
</script>
  </header> 
</body>
</html>
