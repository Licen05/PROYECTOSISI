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
    <link href="CSS/tarea.css" rel="stylesheet" type="text/css" />
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
    <?php   //if para que el estudiante vea la tarea sin (subir entregar tarea), y sdi es profe que solo pueda ver la tarea y editarla  
            
        


            
   
              $idt=$_GET['idT'];
              $sql= "SELECT * FROM  TAREA WHERE id=$idt";
              $resultado=mysqli_query($conn,$sql);
              if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                  while($fila=mysqli_fetch_assoc($resultado)){
                    
                    $titulo=$fila['Titulo'];
                    $descript=$fila['Descripcion'];
                    $fechaET=$fila['FechaEntrega'];
                    $nivel=$fila['Sobre'];
                
                  }}               
?>          
<section class="tarea-card">
        <div class="tarea-header">
            <img src="FOTOS/user.png" class="tarea-user-icon">
            <div class="tarea-info">
                <h3 class="tarea-titulo"><?= $titulo ?></h3>
                <p class="tarea-descripcion"></p>
            </div>
        </div>

        <div class="tarea-detalles">
            <div type="" class="tarea-fecha" value=""><?= $descript ?></div>
            <div type="" class="tarea-fecha" value=""><?= $nivel ?></div>
            <p class="tarea-fecha-entrega">Fecha de entrega: <?= $fechaET ?></p>
        </div>

        <div class="tarea-entrega">
            <button class="btn-subir">Subir archivo</button>
            <button class="btn-entregar">Entregar</button>
        </div>
    </section>
<?php 
       

?>
</main>

<footer>
    <?php include("footer.php"); ?>
</footer>
</body>

</html>