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
.inicio{
    text-decoration: none;
    padding: 16px;
    border-radius: 10px;
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

.logo_cole{
    width: 100px; 
    height: 100px;
    border-radius: 50%;
}

.logo_cole{
    animation: t 0.6s ease;
}
@keyframes t {
    0% {transform: rotate(0deg);}
    100%{transform: rotate(360deg);}
}

 .ft{
    height: 50px;
 }

@media (max-width: 1910px) {

.inicio{
    margin-left: 3px;
  }
  .inicio{
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

.inicio:hover{
    
    background-color: #95a891ff;
    color: rgb(0, 0, 0);
}

}

@media (max-width:790px) {
    body{
            margin: 0px;
            display: grid;
            grid-template-columns: 100%;
            grid-template-rows: 350px; 
            grid-template-rows: auto;
            grid-template-areas: 
            "he";
        
    }
      
}
a{
    text-decoration: none;
}
.inicio{
    padding: 15px;
}
.inicio:hover{
    background-color: white;
    color: white;
}

/* MENÚ */
   .menu{
    background-color: gray;
    display: flex;
    margin: 0px;
    position: relative;
    display: inline-block;
   }
   .menu-boton {
      margin: 10px 0 10px 15px;
      font-size: 24px;
      background: none;
      border: none;
      color: white;
      cursor: pointer;
    }
    .barra {
      display: none;
      flex-direction: column;
      background-color: #35403E;
      color: white;
      position: absolute;
      box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
      z-index: 3;
    }

    .botones{

    display: flex;
    flex-wrap: wrap;
    width: 50%;
    flex-direction: column;
    gap: 10px;
    border: none;
    list-style: none;
    
}
    .barra.activo {
      display: flex;
      
    }

    .bot{
    background-color: #536360ff;;
    display: flex;
    justify-content: center;
    text-align: center;
    font-weight: 500;
    border: none;
    color: white;
    transition: 0.3s;
    padding: 10px;
    border-radius: 10px;
    }
    .barra a {
      color: rgb(255, 255, 255);
      text-decoration: none;
      display: block;
    }
    .barra a:hover {
      background-color: #5d6664ff;
    }
  </style>

    </style> 
</head> 

    <header> 
      <div class="encabezado"> 
        <a href="inicio.php"><img src="FOTOS/logo.jpeg" class ="logo_cole"/></a>    
        <a href="inicio.php" class="titulo">Unidad Educativa René Barrientos</a>
      </div>
        <div class="menu">
            <button onclick="toggleMenu()" class="menu-boton"><img class="ft" src="FOTOS/barras2.png"></button>
            <nav class="barra" id="menu">
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
      const barra = document.getElementById('menu');
      barra.classList.toggle('activo');
    }
  </script>
  </header> 
</body>
</html>