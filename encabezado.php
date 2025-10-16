
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8"> 
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="CSS/encabezado.css">
    </head>
    <body>
      <header class="hea"> 
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
    </body>
    </html>
    
