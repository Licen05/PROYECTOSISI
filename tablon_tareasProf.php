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
}?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>ForwardSoft</title>
    <link href="CSS/tablontareas.css"rel="stylesheet" type="text/css" />
    <link href="CSS/boton_eliminarPubli.css" rel="stylesheet" type="text/css" />
    <style>
        
.tareita{
    display: flex;
    padding: 20px 30px 30px 30px;
    background-color: rgb(255, 255, 255);
    box-shadow: 0 0px 5px 5px rgba(168, 168, 168, 1);
    flex-direction: column;
    flex-wrap: wrap;
    border: 0px solid ;
    border-radius: 30px;
    margin: 15px;
    width: 50%;
}
.ntarea{
    font-size:40px;
}
.des{
    padding:0px 0px 30px 10px;
}
.ntarea{
    border-bottom: 2px solid;
    padding-bottom: 4px;
}
.des,.editar{
    font-family: 'Questrial', sans-serif; 
}
.tare{
    display: flex;
    flex-direction: row;
    justify-content: right;
    text-align: center;
    gap: 30px;
   
}
.fr{
  background-color: #384442;
  color: #ffffffff ;
  padding: 8px;
  border: 0px solid ;
  border-radius: 15px;
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
            $id_ = $_GET['ID']; // ID de la clase
            if ($_SESSION['rol'] == 1) {
                $linkTarea = "clases.php?ID=$id_";
            } elseif ($_SESSION['rol'] == 2) {
                $linkTarea = "clases_pr.php?ID=$id_";
            } else {
                $linkTarea = "#"; // por si no hay rol válido
            }
            ?>
            <a href="<?= $linkTarea ?>" class="cuadros">PUBLICACIONES</a>
            <span id="archiv2"><img src="FOTOS/archiv.png" id="archiv"></span>
        </div>
        </div>
    </section>

   <section id="dos">
    <?php if ($_SESSION['rol'] == 2): ?>
        <div class="boton_unir">
            <a id="c_tarea" href="formTarea.php?ID=<?= $id ?>">CREAR UNA TAREA</a>
        </div>
    <?php endif; ?>
  
            <?php
             $idp=$_SESSION['ci'];
              $sql= "SELECT * FROM  CLASES WHERE Profesor=$idp";
              $resultado=mysqli_query($conn,$sql);
              if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                  while($fila=mysqli_fetch_assoc($resultado)){
                    
                    $titulo=$fila['Materia'];
                    $curso=$fila['Grado'];
                    $ID_Clase = $fila["ID"];
                  }}
             
$sql= "SELECT * FROM  TAREA WHERE CLASES_ID=$id";
$resultado=mysqli_query($conn,$sql);

if (!empty($resultado) && mysqli_num_rows($resultado)>0) {
    while($fila=mysqli_fetch_assoc($resultado)){
        $idT = $fila['id'];
        $titulo = $fila['Titulo'];
        $curso = $fila['Descripcion'];
?>
        <!-- Cada tarea va en su propio div -->
        <div class="tareita">
            <h3 class="ntarea"><?= htmlspecialchars($titulo) ?></h3>
            <h4 class="des"><?= htmlspecialchars($curso) ?></h4>

            <div class="tare">
                <div class="editar">
                    <a href="tarea.php?ID=<?= $id ?>&idT=<?= $idT ?>" class="fr">Ver detalles</a>
                </div>

                <?php if ($_SESSION['rol'] == 2): ?>
                    <div class="editar">
                        <a href="revisar.php?ID=<?= $id ?>&idT=<?= $idT ?>" class="fr">Revisar</a>
                    </div>
                    <div class="editar">
                        <a href="formEditTarea.php?ID=<?= $id ?>&idT=<?= $idT ?>" class="fr">Editar</a>
                    </div>
                <?php endif; ?>
            </div>
        </div> <!-- 🔹 cierre de cada tarea -->
<?php
    }
} else {
?>
    <div>  
        <nav class="ambos">
            <img class="conejo" src="FOTOS/conejo.png">
            <h3 class="texto">NO HAY TAREAS AÚN</h3>
        </nav>
    </div>
<?php
}
?>

                
            
            </nav>
            </div>
            </div> 
    </section>
</div>  
        

<footer><?php include("footer.php"); ?>  </footer>    
</body>
</html>