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


$sql = "SELECT * FROM PUBLICACIONES WHERE idP = $ID_Publi";
$resultado = $conn->query($sql);

$asunta = '';
$texto = '';

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $asunta = $fila['Asunto'];
    $texto = $fila['Texto'];
} else {
    echo "<p style='color:red;'>Error: publicación no encontrada.</p>";
}
?>
<div class="todo">
    <div class="she">
        <div class="formulario">
            <div class="marg">
                <div class="uno">
                    <a href="inicioPR.php"><img class="out" src="FOTOS/out.png"></a>
                </div>
                <div class="dos">
                    <h2 class="titulo">EDITA LA PUBLICACION</h2>
                    <div class="centro">
                        <form action="EditarPublicacion.php" method="post" class="campos" id="formulario">
                            <div class="div1">
                                <label for="name">Asunto:</label><br>
                                <input type="text" id="name" name="asu" class="camp" value="<?= htmlspecialchars($asunta) ?>" />
                            </div>

                            <div class="div2">
                                <label for="grado">Contenido:</label><br>
                                <input type="text" id="grado" name="conte" class="camp" value="<?= htmlspecialchars($texto) ?>" />
                            </div>

                            <input type="hidden" name="idP" value="<?= $ID_Publi ?>">

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
</script>
</body>
</html>
