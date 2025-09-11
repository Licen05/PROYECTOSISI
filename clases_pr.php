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
// Recuperar nombre de usuario si no está en sesión
if (!isset($_SESSION['nombre_usuario'])) {
    $ci = $_SESSION['ci'];
    $sql_nombre = "SELECT Nombres FROM informacion WHERE CI = ?";
    $stmt_nombre = $conn->prepare($sql_nombre);
    $stmt_nombre->bind_param("s", $ci);
    $stmt_nombre->execute();
    $res_nombre = $stmt_nombre->get_result();
    if ($res_nombre && $res_nombre->num_rows > 0) {
        $_SESSION['nombre_usuario'] = $res_nombre->fetch_assoc()['Nombres'];
    } else {
        $_SESSION['nombre_usuario'] = "Usuario desconocido";
    }
    $stmt_nombre->close();
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
    <link href="CSS/clases_p.css"rel="stylesheet" type="text/css" />
    <style>
        .texto{
            color:white;
            padding-left:20px;
        }
        .pu{
            border: 1px solid white;
            border-radius: 15px;
            width: 99%;
        }
        .imagen{
            margin-top:10px;
            display:flex;
            flex-direction:column;
            justify-content: right;
        }
        
.nombre{
    font-size: 40px;
    color: white;
}

.titulo {
  font-size: 80px;
  color: rgb(255, 255, 255);
}
.caja_comentario{
        font-family:'Questrial','serif sans';
        padding:-20px;
}
.todd{
    display:flex;
    flex-direction:column;
    width: 223%;
     gap:10px;
     padding-top:20px;
}
    .archiv{
        padding:10px;
        display:flex;
        justify-content:space-between;
    }
    #l_archiv{
        margin:0px 0px 0px 11px;
    }
    .file{
        padding:12px;
        margin:0px -20px 0px 0px;
    }
    .hd{
        margin:0px -40px 0px 0px;
        border:1px solid black;
        font-size:16px;
    }
    .b_file{
        border:1px solid black;
        border-radius:12px;
        padding:10px;
    }
    .b_file:hover{
        background-color:rgba(55, 65, 55, 1);
        color: rgb(255, 255, 255);
    }
.asunto_publi,.coment,.archiv{
    width: 100%;
    height:60px;
    display:flex;
    align-items:center;

}
        </style>
</head>

<body class="clases_p">
    <header class="hea">
        <nav id="cabecera">
        <a href="inicioPR.php"><img class="out" src="FOTOS/au.png" width="60px"></a>
            <div class="imagen">
                <div class="titulo"><?= htmlspecialchars($titulo) ?></div>
                <div class="titulo"><?= htmlspecialchars($curso) ?></div>
            </div>
        </nav>
    </header>
<section id="uno">
    <div id="b_class">
        <?php include("botones_class.php");?>
    </div>
</section>


    <section id="dos">
                    <div class="caja_comentario">
                        <form action="datos_clases.php" method="post" id="form_publi" enctype="multipart/form-data">
                            <div class="todd">
                            <div class="asunto_publi">
                                <label class="label"> Escribe el asunto de la publicación: </label>
                                <input type="text" name="asunto" class="publica">
                            </div>  

                            <div class="coment">
                                <label class="label">Publica algo en tu clase: </label>
                                <textarea name="publi" cols="40" rows="2" required class="publica"></textarea>
                            </div>

                            <div class="archiv">
                                <label class="label">Adjunta un archivo si quieres: </label>

                                <div class="file">
                                    <input type="file" id="archivo" name="archivo" class="publica" style="display:none;">
                                    <label for="archivo" class="b_file"> Sube tu archivo</label>
                                </div>

                            </div>

                            <div class="enviar">
                                <input type="submit" class="hd" value="Enviar" id="b_enviar">
                                <input type="hidden" name="id" value="<?= $id ?>">
                            </div>
                            </div>
                        </form>
                    </div>
    </div>
</div>  
        <h2 class="pub">Publicaciones</h2>
        <div class="pu">
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


                            $texto = htmlspecialchars($fila['Texto']);
                            $asunta = htmlspecialchars($fila['Asunto']);
                            $documento   = $fila['Archivo'];
                            $idPublicacion = $fila['idP']; 
                    ?>
                            <div class='caja_comentario_2'>
                                <div class='profe'>
                                    <img src='FOTOS/user.png' id='user'>
                                    <p class='datos_profe'><?=$autorPublicacion?></p>
                                    <div class='editar'> 
                                        <a href='formEditPubli.php?idP=<?=$idPublicacion?>'>
                                        <?php
                                              // Solo mostrar botón si el autor de la publi = el de la sesión
    if (isset($_SESSION['nombre_usuario']) && $_SESSION['nombre_usuario'] == $fila['Autor']) {
        echo "<a href='formEditPubli.php?idP=$idPublicacion'><img src='FOTOS/edit.png' width='40px'></a>";
    }//aqui ya da solo falta copiar en clases.php y ver si da sin ningun problema


                                        ?>
                                        </a>

                                        <button onclick='mostrarModal(<?=$idPublicacion?>)' style='background: none; border: none; padding: 0;'>
                                        <img src='FOTOS/borra.jpg' width='40px'>
                                        </button>
                                    
                                    </div>                   
                                </div>
                                <?=$editado?><input type='datetime-local' class='datos_profe' value='<?=$fechaMostrar?>' readonly>
                                
                                <div class='publicado'>
                                    <div class='respuesta_asu'>ASUNTO: <?=$asunta?></div>
                                    <div class='respuesta'><?=$texto?></div>
                                    

    <?php 
    $archivoEncontrado = null;
    if (!empty($documento)) {
    $extensiones = ["pdf","jpg","jpeg","png","gif","webp","docx","xlsx","txt","zip"];
    $extension = strtolower(pathinfo($documento, PATHINFO_EXTENSION));

    // Usamos ruta absoluta para verificar, pero mostramos la relativa
    $rutaCompleta = __DIR__ . "/" . $documento;

    if (file_exists($rutaCompleta)) {
        if (in_array($extension, ["jpg","jpeg","png","gif","webp"])) {
            echo "<img src='$documento' alt='Archivo' width='250'>";
        } elseif ($extension == "pdf") {
            echo "<embed src='$documento' type='application/pdf' width='400' height='250'>";
        } else {
            echo "<a href='$documento' download> Descargar archivo</a>";
        }
    } else {
        echo "<p>(Archivo no encontrado en el servidor: $documento)</p>";
    }
}

    ?></div>
                                </div>
                            </div>
                    <?php    
                        }
                    } else {
                        ?><p class="texto2">No hay publicaciones aún. :D</p><?php
                    }
            ?>
         </div>   
    </section>  
   
<!-- MODAL DE CONFIRMACIÓN -->
<div id="modalConfirm" class="modal" style="display:none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
  <div class="modal-content" style="background: white; margin: 15% auto; padding: 20px; border-radius: 8px; width: 300px; text-align: center;">
    <p>¿Deseas eliminar esta publicación?</p>
    <div style="margin-top: 15px;">
      <button id="btnConfirmarEliminar" style="margin-right: 10px;">Sí</button>
      <button id="btnCancelarEliminar">Cancelar</button>
    </div>
  </div>
</div>

<script>
  let idAEliminar = null;

  function mostrarModal(idP) {
    idAEliminar = idP;
    document.getElementById("modalConfirm").style.display = "block";
  }

  document.getElementById("btnCancelarEliminar").onclick = function() {
    document.getElementById("modalConfirm").style.display = "none";
    idAEliminar = null;
  };

  document.getElementById("btnConfirmarEliminar").onclick = function() {
    if (idAEliminar !== null) {
      const form = document.createElement("form");
      form.method = "post";
      form.action = "eliminarPublicacion.php";

      const input = document.createElement("input");
      input.type = "hidden";
      input.name = "idP";
      input.value = idAEliminar;

      form.appendChild(input);
      document.body.appendChild(form);
      form.submit();
    }
  };
</script>
<footer><?php include("footer.php"); ?>  </footer>    
</body>
</html>