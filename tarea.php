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
$descript = $filat['Descripcion'];
$fechaET = $filat['FechaEntrega'];
$nivel = $filat['Sobre'];
$documento = $filat['Archivo'];
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
                $linkTarea = "tablon_tareas.php?ID=$id_";
            } elseif ($_SESSION['rol'] == 2) {
                $linkTarea = "tablon_tareasProf.php?ID=$id_";
            } else {
                $linkTarea = "#"; 
            }
            ?>
            <a href="<?= $linkTarea ?>"><img class="out" src="FOTOS/out.png" width="50px"></a>
            <div class="imagen">
                <div class="titulo"><?= htmlspecialchars($titulo) ?></div>
                <div class="nombre_prof"><?= htmlspecialchars($curso) ?></div>
            </div>
        </nav>
    </header>
 
    <main>
        <section class="tarea-card">
            <div class="tarea-header">
                <img src="FOTOS/user.png" class="tarea-user-icon">
                <div class="tarea-info">
                    <h3 class="tarea-titulo"><?= htmlspecialchars($tituloTarea) ?></h3>
                     <p class="tarea-fecha-entrega"><strong>Fecha de entrega:</strong> <?= $fechaET ?></p>
        
                </div>
            </div>

            <div class="tarea-detalles">
                <p class="tarea-descripcion"><?= (htmlspecialchars($descript)) ?></p>
                <p class=""><?= (htmlspecialchars($documento)) ?></p>
                <p><strong>Puntos:</strong> .../<?= htmlspecialchars($nivel) ?></p>
               
            </div>

            <div class="tarea-acciones">
                <?php if ($_SESSION['rol'] == 1): ?>
                    <!-- Estudiante -->
                   <form action="datos_revisar.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="idClase" value="<?= $id ?>">
    <input type="hidden" name="idTarea" value="<?= $idT ?>">
    <input type="hidden" name="ci" value="<?= $ci ?>"> 
                        
    <textarea name="respuesta" placeholder="Escribe tu respuesta..." required></textarea>
    <input type="file" name="archivo">
    <button type="submit" class="btn-entregar">Entregar</button>
    <a href="tablon_tareas.php?id=<?= $idT ?>"></a>
</form>

                <?php 
                elseif ($_SESSION['rol'] == 2): ?>
                    <!-- Profesor -->
                   <a href="revisar.php?ID=<?= $id ?>&idT=<?= $idT ?>" class="btn-revisar">Revisar entregas</a>

                <?php endif; ?>
            </div>

            <div class="tarea-comentarios">
                <h4>Comentarios de la tarea</h4>
                <form action="comentario_tarea.php" method="post">
                    <input type="hidden" name="idt" value="<?= $idt ?>">
                    <textarea name="comentario" placeholder="Añade un comentario..." required></textarea>
                    <button type="submit" class="btn-comentar">Comentar</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>
