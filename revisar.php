<?php

date_default_timezone_set('America/La_Paz');
include("bd.php"); // Asegúrate que aquí se cree la conexión: $conn = new mysqli(...);

if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

// Redirigir si el rol es 1 (según tu lógica)
if (isset($_SESSION['rol']) && $_SESSION['rol'] == 1) {
    header("Location: inicioES.php");
    exit();
}

// Validar ID 
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    die("ID de clase no válido.");
}

$id = intval($_GET['ID']);
$sql = "SELECT * FROM CLASES WHERE ID = $id";
$resultado = mysqli_query($conn, $sql);

if ($resultado && mysqli_num_rows($resultado) > 0) {
    $fila = mysqli_fetch_assoc($resultado);
    $titulo = $fila['Materia'];
    $curso = $fila['Grado'];
} else {
    die("Clase no encontrada.");
}

// Datos del usuario actual
$idu = $_SESSION['ci'];

// Consultar nombre y apellido del usuario actual
$sqlInfo = "SELECT Nombres, Apellidos FROM INFORMACION WHERE CI = '$idu'";
$resInfo = mysqli_query($conn, $sqlInfo);
if ($resInfo && mysqli_num_rows($resInfo) > 0) {
    $userInfo = mysqli_fetch_assoc($resInfo);
    $nombre = $userInfo['Nombres'];
    $apellido = $userInfo['Apellidos'];
} else {
    $nombre = "Desconocido";
    $apellido = "";
}

// Consultar datos de la tarea
if (!isset($_GET['idT']) || !is_numeric($_GET['idT'])) {
    die("ID de tarea no válido.");
}
$idt = intval($_GET['idT']);
$sqlTarea = "SELECT * FROM TAREA WHERE id = $idt";
$resTarea = mysqli_query($conn, $sqlTarea);

if ($resTarea && mysqli_num_rows($resTarea) > 0) {
    $filaT = mysqli_fetch_assoc($resTarea);
    $tituloTarea = $filaT['Titulo'];
    $descript = $filaT['Descripcion'];
    $fechaET = $filaT['FechaEntrega'];
} else {
    die("Tarea no encontrada.");
}


?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>ForwardSoft</title>
    <link href="CSS/revisar.css" rel="stylesheet" type="text/css" />
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

<section id="uno">
    <div id="b_class">
        <div id="pendientes" class="enlaces">
            <a href="#" class="cuadros" id="tarea">TAREAS</a>
            <img src="FOTOS/tare.png" id="tare">
        </div>
        <div id="personas" class="enlaces">
            <a href="#" class="cuadros">PERSONAS</a>
            <img src="FOTOS/person.png" id="person">
        </div>
        <div id="archivos" class="enlaces">
            <a href="#" class="cuadros">ARCHIVOS</a>
            <span id="archiv2"><img src="FOTOS/archiv.png" id="archiv"></span>
        </div>
        <div id="archivos" class="enlaces">
            <?php  
            $id_ = $_GET['ID'] ?? 0;
            if ($_SESSION['rol'] == 1) {
                $linkTarea = "clases.php?ID=$id_";
            } elseif ($_SESSION['rol'] == 2) {
                $linkTarea = "clases_pr.php?ID=$id_";
            } else {
                $linkTarea = "#";
            }
            ?>
            <a href="<?= $linkTarea ?>" class="cuadros">PUBLICACIONES</a>
            <span id="archiv2"><img src="FOTOS/archiv.png" id="archiv"></span>
        </div>
    </div>
</section>
<div>
    <?php // consultar las tareas entregadas
$ide = intval($_GET['idT']);
$sqlEntrega = "SELECT * FROM ENTREGA WHERE Tarea_id = $ide";
$resEntrega = mysqli_query($conn, $sqlEntrega);

if ($resEntrega && mysqli_num_rows($resEntrega) > 0) {
    while($fila = mysqli_fetch_assoc($resEntrega)){
    $user = $fila['CUENTA_User'];
    $respuesta = $fila['Respuesta'];
    $archivo = $fila['Archivo'];
    $fechaEN = $fila['FechaEnvio'];
    $calificacion = $fila['Calificacion'];
    $fechaRev = $fila['FechaRevision'];

    // Consultar nombre del estudiante
        $sqlEst = "SELECT Nombres, Apellidos FROM INFORMACION WHERE CI = '$user'";
        $resEst = mysqli_query($conn, $sqlEst);
        $nombreEst = "Estudiante desconocido";
        if ($resEst && mysqli_num_rows($resEst) > 0) {
            $estData = mysqli_fetch_assoc($resEst);
            $nombreEst = $estData['Nombres'] . " " . $estData['Apellidos'];
        } ?>
<section class="tarea-card">
            <div class="tarea-header">
                <img src="FOTOS/user.png" class="tarea-user-icon">
                <div class="tarea-info">
                    <h3 class="tarea-titulo"><?= htmlspecialchars($nombreEst) ?></h3>
                    <p class="tarea-fecha-entrega">Fecha de envío: <?= htmlspecialchars($fechaEN) ?></p>
                </div>
            </div>

            <div class="tarea-detalles">
                <p class="tarea-info">Respuesta: <?= htmlspecialchars($respuesta) ?></p>
                <?php if (!empty($archivo)) { ?>
                    <p class="tarea-info">Archivo: 
                        <a href="<?= htmlspecialchars($archivo) ?>" target="_blank">Ver archivo</a>
                    </p>
                <?php } ?>
            </div>
            
            <div class="tarea-entrega">
                <?php if (!empty($calificacion)) { ?>
                <p class="tarea-info"><strong>Calificación:</strong> <?= htmlspecialchars($calificacion) ?></p>
                <p class="tarea-info"><strong>Revisado el:</strong> <?= htmlspecialchars($fechaRev) ?></p>
            <?php } else { ?>
                <form action="datos_revisar.php" method="POST">
                    <input type="hidden" name="idTarea" value="<?= htmlspecialchars($idt) ?>">
                    <input type="hidden" name="idClase" value="<?= htmlspecialchars($id) ?>">
                    <input type="hidden" name="ci" value="<?= htmlspecialchars($user) ?>">
                    
                    <label>NOTA:</label><br>
                    <input type="number" name="calificacion" class="nota"/><br>
                    <div class="enviar"><input type="submit" value="Enviar" id="b_enviar"></div>
                </form>
                 <?php } ?>
    </div>
</section> 
<?php }}else {
    die("No hay entregas aun para esta tarea.");
}?>
        </div>
<footer>
    <?php include("footer.php"); ?>
</footer>
</body>
</html>
