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
if (!isset($_SESSION['ci'])){
    header("Location:FormSession.php");
    exit();
}

$servername = "localhost";
$username = "root"; // tu usuario de MySQL
$password = ""; // tu contraseña de MySQL
$database = "proyectosisi"; // reemplaza con el nombre de tu BD

$conn = mysqli_connect($servername, $username, $password, $database);

// Verificar conexión
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}


// Consulta de temas distintos
$sqlTemas = "SELECT DISTINCT Tema FROM TAREA WHERE Tema IS NOT NULL AND Tema != ''";
$resTemas = mysqli_query($conn, $sqlTemas);

// Array para almacenar los temas
$temas = [];
if ($resTemas && mysqli_num_rows($resTemas) > 0) {
    while ($row = mysqli_fetch_assoc($resTemas)) {
        $temas[] = $row['Tema'];
    }
}
?>
    <div class="todo">
 
        <div class="she"> 
        <div class="formulario">
 
        <div class="marg">
            <div class="uno">   
                <a href="inicioPR.php"> <img class ="out" src="FOTOS/out.png"></a>
            </div>
            <div class="dos">
                <h2 class="titulo">CREA UNA NUEVA TAREA</h2>

                <div class="centro">

                    <form action="datos_tarea.php?" method="POST" class="campos" id="formulario">

                    
                        <div class="preguntas">

                        <div class="div1"> <label for="name">TÍTULO:</label><br>
                        <input type="text" id="name" name="titulo" class="camp"/><br> </div>
<div class="div1">
    <label for="temaSelect">TEMA:</label><br>
    
    <!-- Select con temas existentes -->
    <select id="temaSelect" name="tema_existente" class="camp">
        <option value="">-- Selecciona un tema existente --</option>
        <?php foreach($temas as $tema): ?>
            <option value="<?= htmlspecialchars($tema) ?>"><?= htmlspecialchars($tema) ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>
    
    <!-- Campo para crear tema nuevo -->
    <input type="text" id="temaNuevo" name="tema_nuevo" class="camp" placeholder="O escribe un tema nuevo">
</div>

                        <div class="div2"><label for="grado">DESCRIPCIÓN:</label><br>
                        <input type="text" id="grado" name="descript" class="camp"/><br> </div>

                        <div class="div3"><label for="codi" >FECHA<br>DE ENTREGA:</label><br>
                        <input type="datetime-local" id="codi" name="fechE" class="camp"/><br> </div>

                        <div class="div3"><label for="codi" >PUNTOS:</label><br>
                        <input type="number" id="sobre" name="sobre" class="camp" 
           min="1" max="100" step="1" placeholder="Ej: 100" required><br> </div>
                    
                        </div>

                    <div class="crear" style="position: relative"><button type="submit" class="but">CREAR</button></div>

                    </form>
                    <div class="imagen">
                        <img class="nube" src="FOTOS/nube.png">
                        <h2 class="sube">Sube un documento </h2>
                    </div>
                </div>

            </div>
            </div>
        </div>
        </div>
    </div>
     <?php include("footer.php"); ?>  
 
    <script>
        $(document).ready(function(){
            $("#formulario").validate({

                rules:{
                    Mat:{ required:true, minlength:4},
                    Gra:{ required:true, minlength:4},
                    clase:{ required:true, minlength:6, maxlength: 6}
                },
                messages:{
            Mat: {
                required: "Por favor, ingresa la materia",
                minlength: "Debe tener al menos 4 caracteres"
            },
            Gra: {
                required: "Por favor, ingresa el grado",
                minlength: "Debe tener al menos 4 caracteres"
            },
            clase: {
                required: "Por favor, ingresa el código de clase",
                minlength: "Debe tener exactamente 6 caracteres",
                maxlength: "Debe tener exactamente 6 caracteres"
            }
                }
            
        });
    });
    </script>
</body>
</html>