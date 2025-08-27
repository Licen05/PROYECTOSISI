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
    transform: scale(1.2);
    z-index: 10;
}

@media (max-width:1190px) {
       
.bienvenida{
    display: flex;
    flex-direction: column;
    flex-wrap:wrap;
    gap:5px;
    justify-content:center;
    margin: 15px 10px 10px 10px;
    padding:5px;
}
.ns{
    display:flex;
    flex-wrap:wrap;
}
.pho{
    padding: 2px;
}

.pho:hover{
    transform: scale(1.2);
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
                            <img class="pho" src="FOTOS/1.jpg" width="300px" height="200px">
                            <img class="pho" src="FOTOS/3.jpg" width="300px" height="200px">
                        </div>
                        <div class="ns">
                            <img class="pho" src="FOTOS/4.jpg" width="300px" height="200px">
                            <img class="pho" src="FOTOS/5.jpg" width="300px" height="200px">
                        </div>
                        <h1 class="bienvenidos_texto">CONOCE EL COLEGIO</h1>
                        <div class="ns">
                            <img class="pho" src="FOTOS/8.jpg" width="300px" height="200px">
                            <img class="pho" src="FOTOS/11.jpg" width="300px" height="200px">
                        </div>
                        <div class="ns">
                            <img class="pho" src="FOTOS/2.jpg" width="300px" height="200px">
                            <img class="pho" src="FOTOS/14.jpg" width="300px" height="200px">
                        </div>
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
