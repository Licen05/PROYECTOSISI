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
  <link href="CSS/horarios_form.css" rel="stylesheet" type="text/css" />
  <link href="CSS/inicio.css" rel="stylesheet" type="text/css" />
  <style>
    <style>
/* ===== CONTENEDOR PRINCIPAL ===== */
.centro {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 25px;
  padding: 20px;
}

/* ===== CADA HORARIO ===== */
.horario-item {
  background-color: #f7f7f7;
  border-radius: 15px;
  padding: 15px 20px;
  width: 90%;
  max-width: 700px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.2);
  display: flex;
  flex-direction: column;
  align-items: center;
  animation: fadeIn 0.4s ease;
}

/* ===== CABECERA DEL HORARIO (TÍTULO Y BOTONES) ===== */
.horario-item .header-horario {
  width: 100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.horario-item p {
  font-size: 18px;
  font-weight: bold;
  color: #333;
}

/* ===== BOTONES ===== */
.horario-item .acciones {
  display: flex;
  gap: 10px;
}

.horario-item .acciones a {
  text-decoration: none;
  color: white;
  padding: 6px 12px;
  border-radius: 5px;
  font-weight: bold;
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.horario-item .acciones a:hover {
  transform: scale(1.1);
  opacity: 0.9;
}

.horario-item .editar {
  background: #252a34;
}

.horario-item .eliminar {
  background: #e63946;
}

/* ===== IMÁGENES ===== */
.horario-item img {
  width: 100%;
  border-radius: 10px;
  margin-top: 10px;
  object-fit: contain;
  max-height: 400px;
}

/* ===== ANIMACIÓN ===== */
@keyframes fadeIn {
  from {opacity: 0; transform: translateY(20px);}
  to {opacity: 1; transform: translateY(0);}
}

/* ===== RESPONSIVE ===== */
@media (max-width: 768px) {
  .horario-item {
    width: 95%;
  }
  .horario-item p {
    font-size: 16px;
  }
}


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
  <?php if (isset($_GET['msg']) && $_GET['msg'] == 'eliminado'): ?>
    <div style="background:#4CAF50; color:white; padding:10px; text-align:center; border-radius:8px; margin:10px 0;">
         Horario eliminado correctamente.
    </div>
<?php endif; ?>

  <section class="centro">
              
              <?php
$sqlHor = "SELECT ID, Dia, Imagen FROM horario ORDER BY FIELD(Dia,'Lunes','Martes','Miércoles','Jueves','Viernes')";
$resHor = $conn->query($sqlHor);

if ($resHor && $resHor->num_rows > 0): 
    while ($row = $resHor->fetch_assoc()):
?>
    <div class="horario-item">
        <div class="header-horario">
            <p>Horario: Día <?= htmlspecialchars($row['Dia']) ?></p>

            <?php if (isset($_SESSION['rol']) && $_SESSION['rol'] == 3): ?>
            <div class="acciones">
                <a href="editar_horario.php?id=<?= $row['ID'] ?>" class="editar">Editar</a>
                <a href="eliminar_horario.php?id=<?= $row['ID'] ?>" 
                   onclick="return confirm('¿Seguro que deseas eliminar este horario?')" 
                   class="eliminar">Eliminar</a>
            </div>
            <?php endif; ?>
        </div>

        <img src="<?= htmlspecialchars($row['Imagen']) ?>" alt="Horario <?= htmlspecialchars($row['Dia']) ?>">
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
     <input type="file" name="archivo" id="archivo" required><br>


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
    <script>
document.getElementById('archivo').addEventListener('change', function(){
  const file = this.files[0];
  const nombre = document.getElementById('nombre-archivo');
  if (file) {
    nombre.textContent = " " + file.name;
  } else {
    nombre.textContent = "";
  }
});
</script>

</body>

</html>
