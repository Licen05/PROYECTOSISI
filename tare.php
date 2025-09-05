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
    <style>
        /* Estilos generales de la tarjeta */
.tarea-card { 
    background-color: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 8px;
    padding: 20px;
    margin: 70px ;
    width: 38%;
    max-width: 700px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.tarea-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px white;
}

/* Encabezado de la tarea */
.tarea-header {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
  font-family: 'Graduate', serif;
    border-bottom :1px solid black;
}

.tarea-user-icon {
    width: 60px;
    border-radius: 50%;
    margin-right: 12px;
    border: 2px solid #ddd;
}

.tarea-info {
    flex: 1;
}

.tarea-titulo {
    margin: 0;
    font-size: 1.2rem;
    font-weight: bold;
    font-size:50px;
    color: #202124;
}

.tarea-descripcion {
    color: #000000;
    padding:10px 0px 35px 0px;
    border-bottom: 1px solid black;
}

/* Detalles de la tarea */
.tarea-detalles {
    display: flex;
    flex-direction: column;
    gap: 80px;
    font-family: 'Questrial', sans-serif; 
}
.a-sub{
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
}
.taje{
    padding:15px;
    display:flex;
    justify-content:center;
    border-top:1px solid black;
    border-bottom:1px solid black;
}
.tarea-fecha {
    font-size: 13px;
    width: 80%;
    border: 0px solid ;
    border-radius:12px;
    padding:12px;
    color:white;
    background-color: #646464ff; /* rojo para resaltar fecha límite */
  font-family: 'Questrial', sans-serif; 
}

.tarea-fecha-entrega {
    font-size: 13px;
    width: 80%;
    border: 0px solid ;
    border-radius:12px;
    padding:12px;
    color:white;
    background-color: #d93025; /* rojo para resaltar fecha límite */
  font-family: 'Questrial', sans-serif; 
}

/* Botones de acción */


.btn-subir, .btn-entregar {
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: bold;
    transition: background 0.3s ease, transform 0.2s ease;
}
.btn-revisar{
    font-family: 'Questrial', sans-serif; 
    background-color:black;
    color:white;
    padding:10px ;
    border:0;
    border-radius:12px;
    display:flex;
    justify-content:right;
    justify-content:center;
}

.btn-subir {
    background-color: #e8f0fe;
    color: #e81a8b;
}
.nota{
    background-color: #749dd3ff;
}

.btn-entregar {
    background-color: #1a73e8;
    color: white;
    margin-top:8px;
}

.btn-subir:hover {
    background-color: #d2e3fc;
    transform: translateY(-2px);
}

.btn-entregar:hover {
    background-color: #1558b0;
    transform: translateY(-2px);
}
.caj{
    width: 98%;
    height:50px;
    border:5px double black;
}
.btn-comentar{
    font-family: 'Questrial', sans-serif; 
    background-color:black;
    color:white;
    padding:10px ;
    border:0;
    border-radius:12px;
}
.tarea-comentarios{
    align-items:left;
    padding:0px 0px 10px 15px;
}
.tarea-acciones{
     border-bottom:2px solid black;
}
.cen{
    display:flex;
    flex-direction:column;
    align-items:center;
}
.no{
     font-family: 'Questrial', sans-serif; 
     height: 30px;
     display:flex;
    align-items:center;
}
.nah{
     font-family: 'Questrial', sans-serif; 
     padding:8px;
     height: 35px;
     width: 90%;
     background-color:#1558b0;
     border:0px;
     border-radius:12px;
     color:white;
     display:flex;
    align-items:center;
    justify-content: center;
}
/* Responsivo para móviles */
@media (max-width: 600px) {
    .tarea-card {
        padding: 12px;
    }

    .tarea-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .tarea-user-icon {
        margin-bottom: 8px;
    }

    .tarea-entrega {
        flex-direction: column;
        width: 100%;
    }

    .btn-subir, .btn-entregar {
        width: 100%;
        text-align: center;
    }
}

/*estilos generales*/

@import url('https://fonts.googleapis.com/css2?family=Graduate&family=Questrial&display=swap');

.clases_p {
  font-family: 'Graduate', serif;
  margin: 0px;
}
a{
    text-decoration: none; 
    color: black;
} 
footer{
  grid-area: fo;
}

.clases_p{     
          background-color: #818181ff;  
          display: grid;
          grid-template-columns: 100%;
          grid-template-rows: auto minmax(1000px, auto) auto;
          grid-template-areas: 
          "cabe"
          "ta"
          "fo";
          margin: 0px;
}    

  .hea{
  grid-area: cabe;
  padding: 30px;
  background-color: #36413fff;
  
}  
.t {
  font-size: 80px;
  color: rgb(255, 255, 255);
  margin-left:22px;
} 

.nof{
    font-size: 40px;
    color: white;
    margin: 5px 0px 0px 22px;
}

#uno{
    grid-area:ta;
}
footer{
    grid-area:fo;
}
    </style>
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
            <a href="<?= $linkTarea ?>"><img class="out" src="FOTOS/au.png" width="50px"></a><br><br>
            <div class="imagen">
                <div class="t"><?= htmlspecialchars($titulo) ?></div>
                <div class="nof"><?= htmlspecialchars($curso) ?></div>
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
    <p class="tarea-descripcion"><?= htmlspecialchars($descript) ?></p>
            <div class="a-sub">
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
            echo "<img src='FOTOS/al.png' width='100px'>"."<p><strong>Archivo no encontrado en el servidor</strong></p>";
        }
    } else {
        echo "<p>(No se adjuntó archivo)</p>";
    }
    ?>
        </div>
    <p class="taje"><strong class="cant">Puntos:</strong> .../<?= htmlspecialchars($nivel) ?></p>
</div>


            <div class="tarea-acciones">
               <?php if ($_SESSION['rol'] == 1): ?>
    <?php if ($yaEntregado): ?>
        <!-- Ya entregó -->
        <div class="entrega-confirmada">
            
        <div class="cen">
            <div class="no"><p><strong>Ya entregaste esta tarea.</strong></p></div>
            <div class="nah"><p><strong>Fecha de entrega:</strong> <?= $datosEntrega['FechaEnvio'] ?></p></div>
            <div class="no"><p><strong>Archivo:</strong> 
                <?php if (!empty($datosEntrega['Archivo'])): ?>
                    <a href="<?= htmlspecialchars($datosEntrega['Archivo']) ?>" target="_blank">Ver archivo</a>
                <?php else: ?>
                    (No adjuntaste archivo)
                <?php endif; ?>
            </p></div>
        </div>

            <p><strong>Respuesta:</strong> <?= htmlspecialchars($datosEntrega['Respuesta']) ?></p>
        </div>
    <?php else: ?>
        <!-- Formulario para entregar -->
        <form action="datos_revisar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idClase" value="<?= $id ?>">
            <input type="hidden" name="idTarea" value="<?= $idT ?>">
            <input type="hidden" name="ci" value="<?= $ci ?>"> 
            
            <textarea name="respuesta" placeholder="Escribe tu respuesta..." required></textarea>
            <input type="file" name="archivo">
            
            <button type="submit" class="btn-entregar">Entregar</button>
        </form>
    <?php endif; ?>

<?php elseif ($_SESSION['rol'] == 2): ?>
    <!-- Profesor -->
    <a href="revisar.php?ID=<?= $id ?>&idT=<?= $idT ?>" class="btn-revisar">Revisar entregas</a>
<?php endif; ?>

            </div>

            <div class="tarea-comentarios">
                <h4 class="co">Comentarios de la tarea</h4>
                <form action="comentario_tarea.php" method="post">
                    <input type="hidden" name="idt" value="<?= $idt ?>">
                    <textarea name="comentario" placeholder="Añade un comentario..." required class="caj"></textarea>
                    <br> <br><button type="submit" class="btn-comentar">Comentar</button>
                </form>
            </div>
        </section>
    </main>

    <footer>
        <?php include("footer.php"); ?>
    </footer>
</body>
