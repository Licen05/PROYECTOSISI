<?php
include("bd.php");

        if($_SESSION['rol']==2)
            header("Location:inicioPR.php");
// Conexión a la base de datos
    date_default_timezone_set('America/La_Paz');

if (!isset($_SESSION['ci'])) {
    header("Location:FormSession.php");
    exit();
}

// Obtener datos de la clase actual
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    die("ID de clase no válido 000.");
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
    <link href="CSS/clases.css" rel="stylesheet" type="text/css" />
</head>

<body class="clases_p">
    <header class="hea">
        <a href="inicioES.php"><img class="out" src="FOTOS/au.png" width="50px"></a>
        <div class="imagen">
                <div class="titulo"><?= htmlspecialchars($titulo) ?></div>
                <div class="nombre_prof"><?= htmlspecialchars($curso) ?></div>

            </div>
        </nav>
    </header>

   <section id="uno">
    <div id="b_class">
        <div id="pendientes" class="enlaces">
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
            <a href="<?= $linkTarea ?>" class="cuadros" id="tarea">TAREAS</a>
            <img src="FOTOS/tare.png" id="tare">
        </div>
<?php
                                $id=$_SESSION['ci'];
                                $sql= "SELECT * FROM  CLASES_HAS_CUENTA WHERE CUENTA_User=$id";
                                $resultado=mysqli_query($conn,$sql);
                                if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                                    while($fila=mysqli_fetch_assoc($resultado)){
                                     $idClase=$fila['CLASES_ID'];
                                     
                          $sql2= "SELECT * FROM  CLASES WHERE ID=$idClase";
                                      $resultado2=mysqli_query($conn,$sql2);
                                      if (!empty($resultado2)&& mysqli_num_rows($resultado2)>0) {
                                        $fila2=mysqli_fetch_assoc($resultado2);
                                        $ID_Clase = $fila2["ID"];
                                        $titulo=$fila2['Materia'];
                                        $curso=$fila2['Grado'];
                                      }
                                    }
                                }?>
        <div id="personas"  class="enlaces">
            <a href='classmates.php?ID=<?=$ID_Clase?>'class="cuadros">PERSONAS</a>
            <img src="FOTOS/person.png" id="person">
        </div>


        <div id="archivos" class="enlaces">
            <a href="#" class="cuadros">ARCHIVOS</a>
            <span id="archiv2"><img src="FOTOS/archiv.png" id="archiv"></span>
        </div>
         <div id="archivos"  class="enlaces"> 
            
            <a href="" class="cuadros" id="tarea">PUBLICACIONES</a>
            <span id="archiv2"><img src="FOTOS/archiv.png" id="archiv"></span>
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
        <h2 class="pub">Publicaciones</h2>
 <?php
        $sqlPubli = "SELECT * FROM PUBLICACIONES WHERE CLASES_ID = $id ORDER BY Fecha DESC";
        $resPubli = $conn->query($sqlPubli);

        if ($resPubli && $resPubli->num_rows > 0) {
            while ($fila = $resPubli->fetch_assoc()) {
                $autorPublicacion = htmlspecialchars($fila['Autor']);
                // Fecha original
                $fechaOriginal = date("Y-m-d\TH:i", strtotime($fila['Fecha']));
                $fechaMostrar = $fechaOriginal;
                $editado = "";

                // Si existe fecha de edición, usarla
                if (!empty($fila['FechaE'])) {
                    $fechaEdicion = date("Y-m-d\TH:i", strtotime($fila['FechaE']));
                    $fechaMostrar = $fechaEdicion; 
                    $editado = "<span style='color: black; font-weight: bold;'>Edit</span> ";
                }

                // Si existe fecha de edición, usarla
                if (!empty($fila['FechaE'])) {
                    $fechaEdicion = date("Y-m-d\TH:i", strtotime($fila['FechaE']));
                    $fechaMostrar = $fechaEdicion; 
                    $editado = "<span style='color: black; font-weight: bold;'>Edit</span> ";
                }

                $texto = htmlspecialchars($fila['Texto']);
                $asunta = htmlspecialchars($fila['Asunto']);
                $idPublicacion = $fila['idP']; // este es el valor correcto
        ?>
               <div class='caja_comentario_2'>
                    <div class='profe'>
                        <img src='FOTOS/user.png' id='user'>
                        <p class='datos_profe'><?=$autorPublicacion?></p>
                        <div class='editar'> 
                            <a href='formEditPubli.php?idP=<?=$idPublicacion?>'>
                            <?php
                                if ($autorPublicacion==$_SESSION['nombre']) {
                                            echo "<img src='FOTOS/edit.png' width='40px'>";
                                }
                            ?>
                            </a> 
                        </div>                   
                    </div>
                    <?=$editado?><input type='datetime-local' class='datos_profe' value='<?=$fechaMostrar?>' readonly>
                    <div class='publicado'>
                    <div class='respuesta_asu'>ASUNTO: <?=$asunta?></div>

                    <div class='respuesta'><?=$texto?></div></div>

                    
                    </div>
                </div>
        <?php    
            }
        } else {
            echo "<p>No hay publicaciones aún.</p>";
        }
?>
    </section>
<footer>
    <?php include("footer.php"); ?>  </footer>    

</body>
</html>