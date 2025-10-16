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

  <link href="CSS/inicio.css" rel="stylesheet" type="text/css" />
  <style>
    
.bienvenida{
    display: flex;
    flex-direction: column;
    align-items:center;
    margin: 10px 10px 10px 10px;
    background-color: rgba(53, 64, 62, 0.6);
    color:white;
    padding:15px;
}

.parrafo{
  font-family: 'Questrial', sans-serif;
  text-align : center;
  font-size:16px;
    background-color: rgba(53, 64, 62, 0.6);
    padding: 10px;
}
.bienvenidos_texto{
    font-size:50px;
    background-color: rgba(255, 255, 255);
    color:rgba(53, 64, 62);
    padding:5px ;
    margin: 10px 25px 50px 25px;
}
@media (max-width: 1900px) {
.bienvenida{
    display: flex;
    flex-direction: column;
    justify-content:center;
    margin: 80px 10px 10px 10px;
}}
@media (max-width: 790px) {
  .bienvenida {
      display: flex;
      flex-direction: column;
      justify-content:center;
      margin: 100px 10px 10px 10px;
  }
}

/* 🐇 Carrusel del conejo */
.carrusel-conejo {
  position: relative;
  width: 250px;
  height: 250px;
  overflow: hidden;
  margin: 20px auto;
  border-radius: 15px;
  background: rgba(255, 255, 255, 0.1);
}

.carrusel-conejo .imagenes {
  display: flex;
  width: calc(250px * 7);
  animation: moverConejo 4.5s steps(7) infinite; 
}

.carrusel-conejo img {
  width: 250px;
  height: 250px;
  object-fit: contain;
}

@keyframes moverConejo {
  0%   { transform: translateX(0); }
  14%  { transform: translateX(0); }
  28%  { transform: translateX(-250px); }
  42%  { transform: translateX(-500px); }
  57%  { transform: translateX(-750px); }
  71%  { transform: translateX(-1000px); }
  85%  { transform: translateX(-1250px); }
  100% { transform: translateX(-1500px); }
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
                        <h1 class="bienvenidos_texto">UPS DISCULPA</h1>
                        
                        <p>no hay cupos</p>
                        <div class="carrusel-conejo">
  <div class="imagenes">
    <img src="FOTOS/bunny1.png" alt="Conejo 1">
    <img src="FOTOS/bunny2.png" alt="Conejo 2">
    <img src="FOTOS/bunny3.png" alt="Conejo 3">
    <img src="FOTOS/bunny4.png" alt="Conejo 4">
    <img src="FOTOS/bunny5.png" alt="Conejo 5">
    <img src="FOTOS/bunny6.png" alt="Conejo 6">
    <img src="FOTOS/bunny7.png" alt="Conejo 7">
  </div>
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
