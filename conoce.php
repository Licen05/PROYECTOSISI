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
  <title>Conoce</title>

  <link href="CSS/tru.css" rel="stylesheet" type="text/css" />
  <style>
    
.bienvenida{
    display: flex;
    flex-direction: column;
    gap:5px;
    justify-content:center;
    margin: 15px 10px 10px 10px;
    padding:15px;
}

.pho:hover{
    transform: scale(1.5);
    z-index: 10;
}

@media (max-width:790px) {
       
.bienvenida{
    display: flex;
    flex-direction: column;
    flex-wrap:wrap;
    gap:5px;
    justify-content:center;
    margin: 15px 10px 10px 10px;
    padding:15px;
}
.ns{
    display:flex;
    flex-wrap:wrap;
}

.pho:hover{
    transform: scale(1.5);
    z-index: 10;
}

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
  <section class="b_izquierda">
      <?php
include("barra_iz.php");
    ?>
  </section>
  <section class="centro">
              <section class="bienvenida">
                        <div class="ns">
                            <img class="pho" src="FOTOS/SO.jpeg" width="300px" height="200px">
                            <img class="pho" src="FOTOS/SA.jpeg" width="300px" height="200px">
                        </div>
                        <div class="ns">
                            <img class="pho" src="FOTOS/SE.jpeg" width="300px" height="200px">
                            <img class="pho" src="FOTOS/SU.jpeg" width="300px" height="200px">
                        </div>
                        <h1 class="bienvenidos_texto">CONOCE EL COLEGIO</h1>
                        <div class="ns">
                            <img class="pho" src="FOTOS/SO.jpeg" width="300px" height="200px">
                            <img class="pho" src="FOTOS/SA.jpeg" width="300px" height="200px">
                        </div>
                        <div class="ns">
                            <img class="pho" src="FOTOS/SE.jpeg" width="300px" height="200px">
                            <img class="pho" src="FOTOS/SU.jpeg" width="300px" height="200px">
                        </div>
              </section>
    </section> 
             
  <section class="b_derecha">
        <div class="barra_acceso">
            <h2 class="titulo_acceso_online">Acceso Online</h2>
            <div class="tj">
            <a class="ingreso" href="FormSession.php">Ingresa</a></div>
        </div>
        
            <h2 class="cale">Calendario</h2>
        <div class="tj">
            <img class="cal_img" src="FOTOS/calendario.jpg">
        </div>
        <div >
            <h2 class="barra_redes" id="comuni">Dejanos tu comentario :D</h2>
            <div >
            <section id="dos">
  <div class="caja_comentario"> 
   <div class="texto_comentario"> 

   <form  method="post">
    <div class="seh"><p for="" class="comen">Comenta una reseña....</p><img src="FOTOS/burbuja.png" id="burbuja" width="50px" height="50px"></div>
    <div class="seh"><textarea name="comen" id="" cols="40" rows="2"> </textarea>   
    <button type="submit" value="" class="bet"><img src="FOTOS/flecha.png"></button></div>
    </form>
    
   </div>
        </div> 

<h2>Publicaciones</h2>

<div class="scro">
<?php
if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $lineas = array_reverse($lineas);

    // Cargar respuestas
    $respuestas = [];
    if (file_exists($archivo_respuestas)) {
        $res = file($archivo_respuestas, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($res as $r) {
            list($comentario_id, $fecha_r, $autor_r, $contenido_r) = explode('|', $r);
            $respuestas[$comentario_id][] = [
                'fecha' => $fecha_r,
                'autor' => $autor_r,
                'contenido' => $contenido_r
            ];
        }
    }

    foreach ($lineas as $linea) {
        list($id, $fecha, $autor, $contenido) = explode('|', $linea);
        echo '
        
        <div class="caja_comentario_2">
            <div class="ty">
                <img src="FOTOS/user.png" id="user" height="40px" width="40px">
                <p class="datos_profe">' . htmlspecialchars($autor) . '</p>
            </div>
            <input type="datetime-local" class="datos_profe" value="' . date("Y-m-d\TH:i", strtotime($fecha)) . '" readonly>
            <div class="respuesta">' . htmlspecialchars($contenido) . 
            '</div>
        </div>'
            ;
            
     
    }
} else {
    echo '<p class="comen">No hay publicaciones aún.</p>';
}
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
