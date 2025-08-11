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
.exto{
    text-align:center;
}
a{text-decoration:none;
color:#35403E;}

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
                        <h1 class="bienvenidos_texto">SERVICIOS DEL COLEGIO</h1>
                        <h1 class="exto">Puedes encontrarnos en: <a href="https://share.google/fu2lbIrVfBuEjtHOU" target="_blank">Ubicación</a> <br>entre las 13:30 a las 18:00</h1>
                        <div class="ns">
                            <img class="" src="FOTOS/13.jpg" width="300px" height="200px">
                            <img class="" src="FOTOS/14.jpg" width="300px" height="200px">
                        </div>
              </section>
    </section> 
             
  <section class="b_derecha">
        
  <?php
    include("b_dere.php");
    ?>
    
        
</section>

        
  <?php
    include("footer.php");
    ?>
    
</body>

</html>
