<?php
include("bd.php");
// Obtener nombre del usuario desde la base de datos usando su CI
$autor = 'Usuario desconocido';
if (isset($_SESSION['ci'])) {
    $ci = $_SESSION['ci'];
    $sql_nombre = "SELECT Nombres FROM informacion WHERE CI = '$ci'";
    $res_nombre = $conn->query($sql_nombre);
    if ($res_nombre && $res_nombre->num_rows > 0) {
        $autor = $res_nombre->fetch_assoc()['Nombres'];
    }
}

// Guardar comentario principal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comen'])) {
    $contenido = trim($_POST['comen']);
    date_default_timezone_set('America/La_Paz');
    $fecha = date("Y-m-d H:i:sa");
    $id_comentario = uniqid();

    $entrada = "$id_comentario|$fecha|$autor|$contenido" . PHP_EOL;
    file_put_contents($archivo, $entrada, FILE_APPEND);
}


?>
<!DOCTYPE html> 
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Alumno</title>

  <link href="CSS/tru.css" rel="stylesheet" type="text/css" />
  <style>
    .bienvenida{
      margin-top:-10px;
    }
    .parrafo{
      text-align:center;
      font-family:'Questrial', sans-serif ;
    }
    </style>
</head>
 
<body class="gg">

  <header> 
        <?php
    include("encabezado.php");
    ?>
  </header> 
  <div class="cuerpo">
  <section class="b_izquierda"> <?php
    include("barra_iz.php");
?>
  </section>
  <section class="centro">
              <section class="bienvenida">
                        <h1 class="bienvenidos_texto">HIMNO AL COLEGIO</h1>
                        <h1 class="bienvenidos_texto">RENE BARRIENTOS ORTUÑO A</h1>
                        <aside class="parrafo">
                        <p>


                              Letra: Prof. Lydia Medrano Pozo  - Prof. Melita del Carpio <br>
                              Musica: Prof. Walter Gonzales Toranzos.<br><br><br>


                              De pie todos con la parte en alto<br>
                              con firmeza entonemos la voz<br>
                              con promesa de estudio constante (Bis)<br>
                              ce inquietud, voluntad y tesón. <br>
                              <br>
                              <br>
                              Estudiantes consientes y altivos <br>
                              sabia nueva de fuerza y valor<br>
                              somos hoy juventud que construye<br>
                              de esta patria un destino mejor<br>
                              <br>
                              <br>
                              Nuevo tiempo se gesta en tus aulas (Bis)<br>
                              de esperanza para el porvenir<br>
                              la exigencia del cambio nos llamo<br>
                              es el reto para construir<br>
                              <br>
                              <br>
                              ¡Adelante Colegio Barrientos!  (Bis)<br>
                              no  detengas tu avance jamás<br>
                              yo te ofrezco mi noble energía<br>
                              trabajando forjemos la paz

</p>
                        </aside>
              </section>
    </section> 
             
  <section class="b_derecha">
        <div class="barra_acceso">
            <h2 class="titulo_acceso_online">Acceso Online</h2>
            <div class="tj">
            <a class="ingreso" href="FormSession.php">Ingresa</a></div>
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


  </section>
  </div>
</div>
        </div> 
</div>
        
</section>

        
  <?php
    include("footer.php");
    ?>
    
</body>

</html>
