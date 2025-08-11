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
    .parrafo{
      text-align:center;
    }
    .bienvenida{
      margin-top:10px;
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
                        <h1 class="bienvenidos_texto">HORARIOS DE CLASE</h1>
                        <aside class="parrafo">
                          <div>
                          <p>Horario: Dia LUNES</p>
                        <img src="FOTOS/lunes.png" width="100%">
                        </div>
                        <div>
                          <p>Horario: Dia MARTES</p>
                        <img src="FOTOS/martes.png" width="100%">
                        </div>
                        <div>
                          <p>Horario: Dia MIERCOLES</p>
                        <img src="FOTOS/miercoles.png" width="100%">
                        </div>
                        <div>
                          <p>Horario: Dia JUEVES</p>
                        <img src="FOTOS/jueves.png" width="100%">
                        </div>
                        <div>
                          <p>Horario: Dia VIERNES</p>
                        <img src="FOTOS/viernes.png" width="100%">
                        </div>
                        
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
