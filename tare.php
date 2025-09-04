<?php
date_default_timezone_set('America/La_Paz');
        include("bd.php");
       

// Conexión a la base de datos
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
} else {
    die("Clase no encontrada.");
}

?>

<!DOCTYPE html>
<html>

<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>ForwardSoft</title>
    <link href="CSS/tarea.css" rel="stylesheet" type="text/css" />
    <style>
        /* Estilos generales de la tarjeta */
.tarea-card { 
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 26px;
    margin: 70px ;
    width: 50%;
    max-width: 700px;
    font-family: Arial, sans-serif;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.tarea-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.15);
}

/* Encabezado de la tarea */
.tarea-header {
    display: flex;
    align-items: center;
    margin-bottom: 12px;
}

.tarea-user-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
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
    color: #202124;
}

.tarea-descripcion {
    margin: 4px 0 0;
    color: #000000;
}

/* Detalles de la tarea */
.tarea-detalles {
    margin: 12px 0;
    display: flex;
    flex-direction: column;
    gap: 80px;
}

.tarea-fecha {
    padding: 6px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 0.9rem;
    width: fit-content;
    color: #3c4043;
}

.tarea-fecha-entrega {
    font-size: 0.9rem;
    color: #d93025; /* rojo para resaltar fecha límite */
    font-weight: 500;
}

/* Botones de acción */
.cajita{
    padding: 20px;
    background-color: red;
}
.tarea-entrega {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 10px;
    background-color: green;
}

.btn-subir, .btn-entregar {
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 0.9rem;
    font-weight: bold;
    transition: background 0.3s ease, transform 0.2s ease;
}

.btn-subir {
    background-color: #e8f0fe;
    color: #e81a8b;
}
.nota{
    background-color: #a9c8f1;
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
          background-color: #ffffff;  
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
  background-color: #384442;
  
}       

.titulo {
  font-size: 80px;
  color: rgb(255, 255, 255);
  
} 

.nombre_prof{
    font-size: 40px;
    color: white;
    margin-top: 5px;
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
        <a href="clases_pr.php"><img class="out" src="FOTOS/out.png" width="50px"></a>
            <div class="imagen">
                <div class="titulo"><?= htmlspecialchars($titulo) ?></div>
                <div class="nombre_prof"><?= htmlspecialchars($curso) ?></div> 
            </div>
        </nav>
    </header>

    <section id="uno">
        
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
                <a href="uploads/<?= htmlspecialchars($documento) ?>" target="_blank">Ver archivo</a>

                <p><strong>Puntos:</strong> .../<?= htmlspecialchars($nivel) ?></p>
               
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
                <h4>Comentarios de la tarea</h4>
                <form action="comentario_tarea.php" method="post">
                    <input type="hidden" name="idt" value="<?= $idt ?>">
                    <textarea name="comentario" placeholder="Añade un comentario..." required></textarea>
                    <button type="submit" class="btn-comentar">Comentar</button>
                </form>
            </div>
        </section>

    </section>
</div>  
        

<footer><?php include("footer.php"); ?>  </footer>    
</body>
</html>