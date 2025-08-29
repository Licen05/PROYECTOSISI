<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForwardSoft</title>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

    <link rel="stylesheet" href="CSS/form_crearclase.css">
</head>
<body>
    <?php
session_start();
if (!isset($_SESSION['ci'])){
    header("Location:FormSession.php");
}
    
    $servername = "localhost";
    $username = "root";
    $password="";
    $dbname="proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexion fallida: ". $conn->connect_error);
}
$ID_Clase=$_GET['ID'];
$sql = "SELECT * FROM CLASES WHERE ID='$ID_Clase'";
$resultado= $conn->query($sql);
if ($resultado->num_rows > 0) {
    while($fila=$resultado->fetch_assoc()){
        $Materia = $fila['Materia'];
        $Grado = $fila['Grado'];

    }

}
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
    $sobra = $filaT['Sobre'];
    $tema = $filaT['Tema'];
} else {
    die("Tarea no encontrada.");
}

// Consulta de temas distintos
$sqlTemas = "SELECT DISTINCT Tema FROM TAREA WHERE Tema IS NOT NULL AND Tema != ''";
$resTemas = mysqli_query($conn, $sqlTemas);

// Array para almacenar los temas
$temas = [];
if ($resTemas && mysqli_num_rows($resTemas) > 0) {
    while ($row = mysqli_fetch_assoc($resTemas)) {
        $temas[] = $row['Tema'];
    }
}
?>
    <div class="todo">
 
        <div class="she"> 
        <div class="formulario">
 
        <div class="marg">
            <div class="uno">   
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
            </div>
            <div class="dos">
                <h2 class="titulo">EDITA LA TAREA</h2>

                <div class="centro">
                    <form action="EditarTarea.php" method="post" class="campos" id="formulario">
                    
                        <div class="preguntas">

                        <div class="div1"> <label for="name">TITULO</label><br>
                        <input type="text" id="name" name="tit" class="camp" value='<?=$tituloTarea?>'/><br> </div>
                        
                        <div class="div1">
    <label for="temaSelect">TEMA:</label><br>
    
    <!-- Select con temas existentes -->
    <select id="temaSelect" name="tema_existente" class="camp">
        <option value="">-- Selecciona otro tema ya existente o cambiale el nombre al otro tema --</option>
        <?php foreach($temas as $tema): ?>
            <option value="<?= htmlspecialchars($tema) ?>"><?= htmlspecialchars($tema) ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>
    
    <!-- Campo para crear tema nuevo -->
    <input type="text" id="temaNuevo" name="tema_nuevo" class="camp" value='<?=$tema?>'>
</div>
                        <div class="div2"><label for="grado">DESCRIPCIÓN:</label><br>
                        <input type="text" id="grado" name="descript" class="camp" value='<?=$descript?>'/><br> </div>

                        <div class="div3"><label for="codi" >FECHA<br>DE ENTREGA:</label><br>
                        <input type="datetime-local" id="codi" name="fechE" class="camp" value='<?=$fechaET?>'/><br> </div>

                        <div class="div3"><label for="codi" >SOBRE:</label><br>
                        <input type="number" id="sobre" name="sobre" class="camp" value='<?=$sobra?>'
           min="1" max="100" step="1" placeholder="Ej: 100" required><br> </div>

                    
                    
                    <div class="crear" style="position: relative"><button type="submit" class="but" >EDITAR</button>
                    <!-- Para el id de tarea -->
                    <input type="hidden" name="idT" value="<?=$idt?>">
                    <input type="hidden" name="ID" value="<?=$ID_Clase?>">
                    <div class="crear" style="position: relative"><button type="button" onclick='mostrarModal(<?=$idt?>)'class="but">BORRAR</button></div>
                    </form>
                </div>

            </div>
            </div>
        </div>
        </div>
    </div>
    <!-- MODAL DE CONFIRMACIÓN -->
<div id="modalConfirm" class="modal" style="display:none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.5);">
  <div class="modal-content" style="background: white; margin: 15% auto; padding: 20px; border-radius: 8px; width: 300px; text-align: center;">
    <p>¿Deseas eliminar esta Tarea?</p>
    <div style="margin-top: 15px;">
      <button id="btnConfirmarEliminar" style="margin-right: 10px;">Sí</button>
      <button id="btnCancelarEliminar">Cancelar</button>
    </div>
  </div>
</div>
      <?php
    include("footer.php");
    ?>

 
    <script>
        //eliminar
        let idAEliminar = null;

  function mostrarModal(idt) {
    idAEliminar = idt;
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
      form.action = "eliminarTarea.php";

      const input = document.createElement("input");
      input.type = "hidden";
      input.name = "idt";
      input.value = idAEliminar;

      form.appendChild(input);
      document.body.appendChild(form);
      form.submit();
    }
  };
  //validar
        $(document).ready(function(){
            $("#formulario").validate({

                rules:{
                    Mat:{ required:true, minlength:4},
                    Gra:{ required:true, minlength:4},
                    clase:{ required:true, minlength:6, maxlength: 6}
                },
                messages:{
            Mat: {
                required: "Por favor, ingresa la materia",
                minlength: "Debe tener al menos 4 caracteres"
            },
            Gra: {
                required: "Por favor, ingresa el grado",
                minlength: "Debe tener al menos 4 caracteres"
            },
            clase: {
                required: "Por favor, ingresa el código de clase",
                minlength: "Debe tener exactamente 6 caracteres",
                maxlength: "Debe tener exactamente 6 caracteres"
            }
                },
            
        });
    });
    </script>
</body>
</html>