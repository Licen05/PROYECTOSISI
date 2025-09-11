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
  <link href="CSS/inicio.css" rel="stylesheet" type="text/css"/>
  <link href="CSS/encabezado.css" rel="stylesheet" type="text/css" />
  <link href="CSS/b_izquierda.css" rel="stylesheet" type="text/css" />
  <style>
  
    .bienvenida{
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .ns{
      display: flex;
      justify-content: center;
      gap: 2px;
    }
    .bienvenidos_texto{
      font-size: 50px;
      text-align: center;
    }
    .parrafo{
      font-family:'Questrial', sans-serif;
      font-size:20px;
      text-align: center;
    }
  </style>
</head>
<body class="gg">
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
    <h1 class="bienvenidos_texto">BIENVENIDOS..</h1>
    <div class="ns">
      <img class="pho" src="FOTOS/SO.jpeg" width="200px" height="200px">
      <img class="pho" src="FOTOS/SA.jpeg" width="200px" height="200px">
      <img class="pho" src="FOTOS/SE.jpeg" width="200px" height="200px">
      <img class="pho" src="FOTOS/SU.jpeg" width="200px" height="200px">
     </div>
                        
    <aside class="parrafo">
      <p>Nos sentimos orgullosos por llevar adelante el quehacer pedagógico a partir del enfoque de <br>
      la EDUCACIÓN PERSONALIZADA , que permite brindar una experiencia educativa de crecimiento <br>
      intelectual y espiritual con la participación activa de los estudiantes que forman parte de <br>
      la familia Rene Barrientista.</p>
    </aside>
</section>
</section>         
<section class="b_derecha">  
<?php 
include("b_dere.php");
 ?> 
</section>

</div>
        
<?php include("footer.php"); ?>
    
</body>
</html>
