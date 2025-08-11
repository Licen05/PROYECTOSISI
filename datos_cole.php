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
    $fecha = date("Y-m-d H:i:s");
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
</head>
 
<body class="gg">

  <header> 
        <?php
    include("encabezado.php");
    ?>
  </header> 
  <div class="cuerpo">
  <section class="b_izquierda">
      <?php
    include("barra_iz.php");
?>
  </section>
  <section class="centro">
              <section class="bienvenida">
                        <h1 class="bienvenidos_texto">MISION</h1>
                        <aside class="parrafo">
                        <p>Formar estudiantes con sentido crítico reflexivo, creativos, productivos y de acción <br>
                        transformadora capaces de construir su propio aprendizaje a través de un proceso integral, <br>
                        participativo y significativo fortalecido en valores socio comunitarios que le permitan dar <br>
                        respuesta a sus necesidades y aspiraciones con el apoyo de docentes capacitados y actualizados<br>
                         en nuevos enfoques y estrategias pedagógicas con la participación de la comunidad educativa.
</p>
                        </aside>
                        
                        <h1 class="bienvenidos_texto">VISION</h1>
                        <aside class="parrafo">
                        <p>La Unidad Educativa Rene Barrientos Ortuño “A”, pretende formar estudiantes con saberes <br>
                        humanísticos, científicos que articulen la teoría con la práctica hacia una formación superior, <br>
                        brindando las condiciones óptimas de infraestructura, equipamiento y la participación comprometida <br>
                        de la comunidad educativa.
</p>
                        </aside>
              </section>
    </section> 
             
  <section class="b_derecha">
    
        
  <?php
    include("b_dere.php");
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
