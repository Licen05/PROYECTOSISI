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
    .parrafo{
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
              
              <?php
$sqlHor = "SELECT Dia, Imagen FROM horario ORDER BY FIELD(Dia,'Lunes','Martes','Miércoles','Jueves','Viernes')";
$resHor = $conn->query($sqlHor);

if ($resHor && $resHor->num_rows > 0): 
    while ($row = $resHor->fetch_assoc()):
?>
    <div class="horario-item">
        <p><strong>Horario: Día <?= htmlspecialchars($row['Dia']) ?></strong></p>
        <img src="<?= htmlspecialchars($row['Imagen']) ?>" width="100%">
    </div>
<?php 
    endwhile;
else: 
?>
    <p>No se han subido horarios aún.</p>
<?php endif; ?>
<?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 3): // Solo admin ?>
<section class="form-horario">
  <h3>Subir o actualizar horario</h3>
  <form action="datos_horario.php" method="post" enctype="multipart/form-data">
      <label for="dia">Día:</label>
      <select name="dia" id="dia" required>
          <option value="">Selecciona un día</option>
          <option value="Lunes">Lunes</option>
          <option value="Martes">Martes</option>
          <option value="Miércoles">Miércoles</option>
          <option value="Jueves">Jueves</option>
          <option value="Viernes">Viernes</option>
      </select><br><br>

      <label for="archivo">Subir imagen del horario:</label><br>
      <input type="file" name="archivo" id="archivo" required><br><br>

      <button type="submit">Guardar horario</button>
  </form>
</section>
<?php endif; ?>
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
