<?php
date_default_timezone_set('America/La_Paz');
include("bd.php");

if (!isset($_SESSION['ci'])) {
    header("Location:FormSession.php");
    exit();
}

// Obtener datos de la clase actual
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    die("ID de clase no válido.");
}
$id = intval($_GET['ID']);
$sql = "SELECT * FROM CLASES WHERE ID = $id";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $titulo = $fila['Materia'];
    $curso = $fila['Grado'];
    $prof = $fila['Profesor'];
} else {
    die("Clase no encontrada.");
}
// Obtener datos de la informacion actual

$ci = $_SESSION['ci'];
$sql = "SELECT * FROM INFORMACION WHERE CI = $ci";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $filap = $resultado->fetch_assoc();
    $nombre = $filap['Nombres'];
    $apellido = $filap['Apellidos'];
   
} else {
    die("nombre no encontrado.");
}

// Obtener datos de la tarea
if (!isset($_GET['idT']) || !is_numeric($_GET['idT'])) {
    die("ID de tarea no válido.");
}
$idT = intval($_GET['idT']);
$sql = "SELECT * FROM TAREA WHERE id = $idT";
$resultado = $conn->query($sql);

if (!$resultado || mysqli_num_rows($resultado) == 0) {
    die("Tarea no encontrada.");
}
$filat = mysqli_fetch_assoc($resultado);

$tituloTarea = $filat['Titulo'];
$descript    = $filat['Descripcion'];
$fechaET     = $filat['FechaEntrega'];
$nivel       = $filat['Sobre'];
$documento   = $filat['Archivo'];


//si ya entrego ya no mas
$yaEntregado = false;
$datosEntrega = null;

if ($_SESSION['rol'] == 1) { // Solo para estudiantes
    $sqlEntrega = "SELECT * FROM ENTREGA WHERE CUENTA_User = $ci AND Tarea_id = $idT";
    $resEntrega = $conn->query($sqlEntrega);
    if ($resEntrega && $resEntrega->num_rows > 0) {
        $yaEntregado = true;
        $datosEntrega = $resEntrega->fetch_assoc();
    }
}
 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>ForwardSoft</title>
    <link href="CSS/tarea.css" rel="stylesheet" type="text/css" />
    <link href="CSS/clases_p.css" rel="stylesheet" type="text/css" />
    <link href="CSS/boton_eliminarPubli.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="CSS/inicioPR.css">
</head>

<body class="clases_p">
    <header class="hea">
        <nav id="cabecera">
            <?php  
            
            $id_ = $_GET['ID'] ;  
            if ($_SESSION['rol'] == 1) {
                $linkTarea = "tablon_tareasProf.php?ID=$id_";
            } elseif ($_SESSION['rol'] == 2) {
                $linkTarea = "tablon_tareasProf.php?ID=$id_";
            } else {
                $linkTarea = "#"; 
            }
            ?>
            <a href="<?= $linkTarea ?>"><img class="out" src="FOTOS/AU.png" width="50px"></a>
            <div class="imagen">
                <div class="titulo"><?= htmlspecialchars($titulo) ?></div>
                <div class="nombre_prof"><?= htmlspecialchars($curso) ?></div>
            </div>
        </nav>
    </header>
 <center>
    <main>
        <section class="tarea">
            <div class="t_header">
                <img src="FOTOS/user.png" class="tarea-user-icon">
                <div class="t_info">
                    <h3 class="t_titulo"><?= htmlspecialchars($tituloTarea) ?></h3>
                    <div class="t_infos">
                    <p class="t_fechae"><strong>Fecha de entrega:</strong> <?= $fechaET ?></p>
                    <p class="puntaje"><strong>Puntos:</strong> .../<?= htmlspecialchars($nivel) ?></p>
        </div>
                </div>
            </div>
           <div class="t_detalles">
    <p class="t_descripcion"><?= htmlspecialchars($descript) ?></p>

    <?php 
    $archivoEncontrado = null;
    if (!empty($documento)) {
        $extensiones = ["pdf","jpg","jpeg","png","gif","webp","docx","xlsx","txt","zip"];
        $extension = strtolower(pathinfo($documento, PATHINFO_EXTENSION));

        if (file_exists($documento)) {
            $archivoEncontrado = $documento;
        }

        if ($archivoEncontrado) {
            if (in_array($extension, ["jpg","jpeg","png","gif","webp"])) {
                echo "<img src='$archivoEncontrado' alt='Archivo' width='250'>";
            } elseif ($extension == "pdf") {
                echo "<embed src='$archivoEncontrado' type='application/pdf' width='400' height='250'>";
            } else {
                echo "<a href='$archivoEncontrado' download> Descargar archivo</a>";
            }
        } else {
            echo "<p>(Archivo no encontrado en el servidor)</p>";
        }
    } else {
        echo "<p>(No se adjuntó archivo)</p>";
    }
    ?>

</div>


            <div class="tarea-acciones">
               <?php if ($_SESSION['rol'] == 1): ?>
    <?php if ($yaEntregado): ?>
        <!-- Ya entregó -->
        <div class="entrega-confirmada">
            <p><strong>Ya entregaste esta tarea.</strong></p>
            <p><strong>Respuesta:</strong> <?= htmlspecialchars($datosEntrega['Respuesta']) ?></p>
            <p><strong>Archivo:</strong> 
                <?php if (!empty($datosEntrega['Archivo'])): ?>
                    <a href="<?= htmlspecialchars($datosEntrega['Archivo']) ?>" target="_blank">Ver archivo</a>
                <?php else: ?>
                    (No adjuntaste archivo)
                <?php endif; ?>
            </p>
            <p><strong>Fecha de entrega:</strong> <?= $datosEntrega['FechaEnvio'] ?></p>
        </div>
    <?php else: ?>
        <!-- Formulario para entregar -->
        <form action="datos_revisar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idClase" value="<?= $id ?>">
            <input type="hidden" name="idTarea" value="<?= $idT ?>">
            <input type="hidden" name="ci" value="<?= $ci ?>"> 
            
       
   <button><input type="file" name="archivo">Subir Archivo</button>
            
            
            <button type="submit" class="btn-entregar">Entregar</button>
        </form>
    <?php endif; ?>

<?php elseif ($_SESSION['rol'] == 2): ?>
    <!-- Profesor -->
    <a href="revisar.php?ID=<?= $id ?>&idT=<?= $idT ?>" class="btn-revisar">Revisar entregas</a>
<?php endif; ?>

            </div>

            <div class="t_comentarios">
                <h4>Comentarios de la tarea</h4>
                <form action="comentario_tarea.php" method="post" class="form_comen">
                    <input type="hidden" name="idt" value="<?= $idt ?>">
                    <textarea class="text_tarea"name="comentario" placeholder="Añade un comentario..." required></textarea>
                    <button type="submit" class="btn-comentar">Comentar</button>
                </form>
            </div>
        </section>
    </main>
</center>
    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>
