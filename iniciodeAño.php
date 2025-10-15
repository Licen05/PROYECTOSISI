<?php
session_start();

$archivo = 'mensajes.txt';
$archivo_respuestas = 'respuestas.txt';

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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
  <link href="CSS/inicio.css" rel="stylesheet" type="text/css"/>
  <style>

    @import url('https://fonts.googleapis.com/css2?family=Graduate&family=Questrial&display=swap');
    
    body{
      margin: 0px;
      font-family:'Graduate','serif';
    }.parrafo{
      text-align:center;
    }
    .bienvenida{
      display: flex;
      flex-direction:column;
      text-align: center;
      width: 80%;
      padding: 10px;
    }
    .ns{
      display:flex;
      justify-content:center;
      gap:2px;
    }
    .bienvenidos_texto{
      font-size:50px;
      text-align:center;
    }
  </style>
</head>


<header class="he"> 
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
   <h1 class="bienvenidos_texto">EMPEZAMOS EN FEBRERO DE 2026</h1>
<aside class="parrafo">
<p>Inicio de clases </p>
<img src="FOTOS/inicioclases.jpg" width="50%">
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
        
<?php include("footer.php"); ?>
    
</body>
</html>