<?php
include("bd.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: horarios.php");
    exit();
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID no válido.");
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM horario WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Horario no encontrado.");
}
$horario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Editar Horario</title>
<link rel="stylesheet" href="CSS/inicio.css">
<style>
@import url('https://fonts.googleapis.com/css2?family=Graduate&family=Questrial&display=swap');

/* ===== CONTENEDOR PRINCIPAL ===== */
.cuerpo {
  display: grid;
  grid-template-columns: 20% 60% 20%;
  grid-template-areas: "izq cen der";
  gap: 10px;
  margin-top: 20px;
  font-family: 'Questrial', sans-serif;
}

/* ===== FORMULARIO ===== */
.form-editar {
  grid-area: cen;
  background-color: #35403e;
  color: white;
  border-radius: 15px;
  padding: 30px;
  width: 80%;
  margin: 30px auto;
  box-shadow: 0 4px 10px rgba(0,0,0,0.3);
  animation: fadeIn 0.5s ease-in;
}

.form-editar h2 {
  text-align: center;
  font-family: 'Graduate', serif;
  font-size: 28px;
  margin-bottom: 20px;
}

.form-editar img {
  display: block;
  margin: 0 auto 20px auto;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0,0,0,0.4);
}

.form-editar label {
  font-weight: bold;
  display: block;
  margin-bottom: 6px;
}

.form-editar input[type="file"] {
  background: white;
  color: #333;
  padding: 10px;
  border-radius: 10px;
  width: 100%;
  cursor: pointer;
  font-family: 'Questrial', sans-serif;
  box-shadow: inset 0 0 3px rgba(0,0,0,0.3);
  margin-bottom: 15px;
}

.form-editar input[type="file"]::-webkit-file-upload-button {
  background-color: #252a34;
  color: white;
  border: none;
  padding: 8px 15px;
  border-radius: 8px;
  cursor: pointer;
  font-weight: bold;
  transition: background 0.3s ease;
}
.form-editar input[type="file"]::-webkit-file-upload-button:hover {
  background-color: #3f4a44;
}

#nombre-archivo {
  font-style: italic;
  display: block;
  margin-top: 5px;
  color: #ddd;
}

/* ===== BOTONES ===== */
.form-editar button {
  background-color: #ffffff;
  color: #35403e;
  border: none;
  padding: 12px 20px;
  border-radius: 10px;
  font-weight: bold;
  cursor: pointer;
  transition: all 0.3s ease;
  width: 100%;
  font-size: 16px;
}

.form-editar button:hover {
  background-color: #99b19c;
  transform: scale(1.05);
}

.volver {
  text-decoration: none;
  color: white;
  background: #252a34;
  padding: 10px 20px;
  border-radius: 8px;
  display: inline-block;
  margin-top: 20px;
  transition: background 0.3s ease;
}
.volver:hover {
  background: #3f4a44;
}

/* ===== ANIMACIONES ===== */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-10px); }
  to { opacity: 1; transform: translateY(0); }
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {
  .cuerpo {
    grid-template-columns: 100%;
    grid-template-areas: "cen";
  }
  .form-editar {
    width: 95%;
  }
}
</style>
</head>

<body class="gg">
<header>
  <?php include("encabezado.php"); ?>
</header>

<div class="cuerpo">
  <section class="b_izquierda" style="grid-area: izq;">
    <?php include("barra_iz.php"); ?>
  </section>

  <section class="form-editar" style="grid-area: cen;">
    <h2>Editar horario de <?= htmlspecialchars($horario['Dia']) ?></h2>
    <img src="<?= htmlspecialchars($horario['Imagen']) ?>" width="400" alt="Horario actual">

    <form action="datos_horario.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="editar_id" value="<?= $horario['ID'] ?>">
      <label for="archivo">Selecciona nueva imagen:</label>
      <input type="file" name="archivo" id="archivo" required>
      
      <button type="submit" name="accion" value="editar">Actualizar horario</button>
    </form>

    <a class="volver" href="horarios.php">← Volver a horarios</a>
  </section>

  <section class="b_derecha" style="grid-area: der;">
    <?php include("b_dere.php"); ?>
  </section>
</div>

<footer>
  <?php include("footer.php"); ?>
</footer>

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
