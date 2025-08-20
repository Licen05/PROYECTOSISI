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
            <a href="formTarea.php" class="cuadros" id="tarea">TAREAS</a>
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
        <?php if($_SESSION['rol']==1)
            header("Location:clases.php");
        elseif ($_SESSION['rol'] == 2)
        header("Location: clases_pr.php?");
    exit(); ?>    
        <a href="" class="cuadros">TABLON</a>
            <span id="archiv2"><img src="FOTOS/archiv.png" id="archiv"></span>
        </div>
        </div>
    </section>

    <section id="dos">
        <div class="caja_comentario">
            <div class="texto_comentario">
                <form action="datos_clases.php" method="get" id="form_publi">
                    <div class="asunto_publi">
                    <label class="label"> Escribe el asunto de la publicación: </label>
                    <input type="text" name="asunto" class="publica">
                    </div>  
                    <div class="coment">
                    <label class="label">Publica algo en tu clase: </label>
                    <textarea name="publi" cols="40" rows="2" required class="publica"></textarea>
                    <input type="hidden" name="id" value="<?= $id ?>">
                    <div class="enviar"><input type="submit" value="Enviar" id="b_enviar"></div>
                    </div>
                    
                    
                </form>
            </div>
        </div>
</div>  
        

<footer><?php include("footer.php"); ?>  </footer>    
</body>
</html>