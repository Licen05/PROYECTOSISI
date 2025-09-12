<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForwardSoft</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

    <link rel="stylesheet" href="CSS/form_crearclase.css">
</head>
<body>
<?php
session_start();
if (!isset($_SESSION['ci'])) {
    header("Location:FormSession.php");
    exit();
}
$ciSesion = $_SESSION['ci'];  // CI del usuario autenticado
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);

if (!isset($_GET['idP']) || empty($_GET['idP'])) {
    die("Error: No se proporcionó el ID de publicación.");
}

$ID_Publi = intval($_GET['idP']); // seguridad

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener nombre del usuario autenticado
$sqlNombre = "SELECT Nombres FROM informacion WHERE CI = ?";
$stmtNombre = $conn->prepare($sqlNombre);
$stmtNombre->bind_param("s", $ciSesion);
$stmtNombre->execute();
$resNombre = $stmtNombre->get_result();

if ($resNombre->num_rows == 0) {
    die("Error: No se encontró el usuario en la base de datos.");
}
$nombreSesion = $resNombre->fetch_assoc()['Nombres'];

// obtener la publicación
$stmt = $conn->prepare("SELECT * FROM publicaciones WHERE idP = ?");
$stmt->bind_param("i", $ID_Publi);
$stmt->execute();
$res = $stmt->get_result();
if ($res->num_rows === 0) {
    die("Publicación no encontrada.");
}
$pub = $res->fetch_assoc();
$stmt->close();

$asunta = $pub['Asunto'];
$texto  = $pub['Texto'];
$archivo_actual = $pub['Archivo']; // ruta relativa guardada en BD (ej: media/PUBLI-1-....pdf)
$autor_publicacion = $pub['Autor'];
$clase_id = $pub['CLASES_ID'] ?? 0;

// permiso: solo autor puede editar (compara por nombre)
if (trim($autor_publicacion) !== trim($nombreSesion)) {
    die("<p style='color:red;'>No tienes permiso para editar esta publicación.</p>");
}
?>
<div class="todo">
    <div class="she">
        <div class="formulario">
            <div class="marg">
                <div class="uno">
                     <?php   if ($_SESSION['rol'] == 1)
                                echo "<a href='inicioES.php'> " ;
                            if ($_SESSION['rol'] == 2)
                                echo  "<a href='inicioPR.php'> " ; ?>
                   <img class="out" src="FOTOS/au.png"></a>
                </div>
                <div class="dos">
          <h2 class="titulo">EDITA LA PUBLICACIÓN</h2>
          <div class="centro">
            <form action="EditarPublicacion.php" method="post" class="campos" id="formulario" enctype="multipart/form-data">
              <div class="div1">
                <label for="asu">Asunto:</label><br>
                <input type="text" id="asu" name="asu" class="camp" value="<?= htmlspecialchars($asunta) ?>" required />
              </div>

              <div class="div2">
                <label for="conte">Contenido:</label><br>
                <textarea id="conte" name="conte" class="camp" rows="4" required><?= htmlspecialchars($texto) ?></textarea>
              </div>

              <div class="div2">
                <label>Archivo actual:</label><br>
                <?php if (!empty($archivo_actual) && file_exists(__DIR__ . '/' . $archivo_actual)): 
                    $ext = strtolower(pathinfo($archivo_actual, PATHINFO_EXTENSION));
                    if (in_array($ext, ['jpg','jpeg','png','gif','webp'])): ?>
                        <p><img src="<?= htmlspecialchars($archivo_actual) ?>" alt="archivo" style="max-width:300px;"></p>
                    <?php elseif ($ext === 'pdf'): ?>
                        <p><embed src="<?= htmlspecialchars($archivo_actual) ?>" type="application/pdf" width="400" height="220"></p>
                    <?php else: ?>
                        <p><a href="<?= htmlspecialchars($archivo_actual) ?>" target="_blank">Ver / descargar archivo actual</a></p>
                    <?php endif;
                else: ?>
                    <p>(No hay archivo adjunto)</p>
                <?php endif; ?>
              </div>

              <div class="div2">
                <label><input type="checkbox" id="keepFile" name="keepFile" checked> Mantener archivo actual</label>
                <p>Si quieres reemplazar el archivo, desmarca la casilla y sube uno nuevo.</p>

                <input type="file" id="archi" name="archi" class="camp" style="display:block; margin-top:8px;" disabled>
                <!-- guardamos valor actual para backend -->
                <input type="hidden" name="currentFile" value="<?= htmlspecialchars($archivo_actual) ?>">
              </div>

              <input type="hidden" name="idP" value="<?= $ID_Publi ?>">

              <input type="hidden" name="CLASES_ID" value="<?= htmlspecialchars($clase_id) ?>">

              <div class="crear" style="position: relative">
                <button type="submit" class="but">EDITAR</button>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<?php
    include("footer.php");
    ?>


<script>
    $(document).ready(function(){
        $("#formulario").validate({
            rules: {
                asu: { required: true, minlength: 4 },
                conte: { required: true, minlength: 4 }
            },
            messages: {
                asu: {
                    required: "Por favor, ingresa el nuevo asunto",
                    minlength: "Debe tener al menos 4 caracteres"
                },
                conte: {
                    required: "Por favor, ingresa el nuevo contenido",
                    minlength: "Debe tener al menos 4 caracteres"
                }
            }
        });
    });
    // Toggle file input depending on "keepFile" checkbox
  document.getElementById('keepFile').addEventListener('change', function() {
      const fileInput = document.getElementById('archi');
      if (this.checked) {
          fileInput.disabled = true;
          fileInput.required = false;
      } else {
          fileInput.disabled = false;
          fileInput.required = true;
      }
  });
</script>
</body>
</html>
