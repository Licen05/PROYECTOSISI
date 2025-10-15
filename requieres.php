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

  <link href="CSS/inicio.css" rel="stylesheet" type="text/css" />
  <style>
.bienvenida{
    display: flex;
    flex-direction: column;
    align-items:center;
    margin: 10px 10px 10px 10px;
}

.parrafo{
  font-family: 'Questrial', sans-serif;

  font-size:16px;
    border: 2px solid rgba(53, 64, 62);
    padding: 19px;
}
.bienvenidos_texto{
    font-size:40px;
    color:rgba(53, 64, 62);
    padding:5px ;
    margin: 10px 25px 50px 25px;
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
                       
                        <h1 class="bienvenidos_texto">REQUISITOS</h1>
                        <aside class="parrafo">
                        <p>

                              - Certificado de nacimiento o cédula de identidad del estudiante.<br><br>
                              - Libreta de kínder, se solicita la libreta de kínder del segundo trimestre.<br><br>
                              - Documentos de los padres o tutores: Se requiere la cédula de identidad original del padre, madre o tutor.<br><br>
                              

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
