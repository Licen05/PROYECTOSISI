<?php
date_default_timezone_set('America/La_Paz');
        include("bd.php");
        if($_SESSION['rol']==1)
            header("Location:inicioES.php");

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
}?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>ForwardSoft</title>
    <link href="CSS/clases_p.css"rel="stylesheet" type="text/css" />
    <link href="CSS/boton_eliminarPubli.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="CSS/inicioPR.css">
</head>

<body class="clases_p">
    <header class="hea">
        <nav id="cabecera">
        <a href="inicioPR.php"><img class="out" src="FOTOS/out.png" width="50px"></a>
            <div class="imagen">
                <div class="titulo"><?= htmlspecialchars($titulo) ?></div>
                <div class="nombre_prof"><?= htmlspecialchars($curso) ?></div>
            </div>
        </nav>
    </header>

    <section id="uno">
        <div id="b_class">
        <div id="pendientes" class="enlaces">
            <a href="" class="cuadros" id="tarea">TAREAS</a>
            <img src="FOTOS/tare.png" id="tare">
        </div>
        <div id="personas"  class="enlaces">
            <a href="" class="cuadros">PERSONAS</a>
            <img src="FOTOS/person.png" id="person">
        </div>
        <div id="archivos"  class="enlaces">
            <a href="" class="cuadros">ARCHIVOS</a>
            <span id="archiv2"><img src="FOTOS/archiv.png" id="archiv"></span>
        </div>
        
        <div id="archivos"  class="enlaces">
            <?php  
            // Verifica el rol y arma el enlace dinámico
            $id_ = $_GET['ID'] ?? 0; // ID de la clase
            if ($_SESSION['rol'] == 1) {
                $linkTarea = "clases.php?ID=$id_";
            } elseif ($_SESSION['rol'] == 2) {
                $linkTarea = "clases_pr.php?ID=$id_";
            } else {
                $linkTarea = "#"; // por si no hay rol válido
            }
            ?>
            <a href="<?= $linkTarea ?>" class="cuadros" >PUBLICACIONES</a>
            <span id="archiv2"><img src="FOTOS/archiv.png" id="archiv"></span>
        </div>
        </div>
    </section>
   <section>
   <nav class ="tablon">
           
            <div>  
            <nav class="ambos">
            <img class="conejo" src ="FOTOS/conejo.png">
            <h3 class="texto">NO HAY TAREAS AUN</h3>
            
                <div class="ajo">
                <a class="boton_unir" href="formTarea.php">CREA A UNA TAREA</a>
            
                </div>
            
            </nav>
            </nav>
            </div> 
    </section>
</div>  
        

<footer><?php include("footer.php"); ?>  </footer>    
</body>
</html>