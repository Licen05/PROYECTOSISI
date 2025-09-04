<?php
$servername = "localhost";
$username = "root";
$password="";
$dbname="proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexion fallida: ". $conn->connect_error);
}


session_start();
if (!isset($_SESSION['rol'])) {
    die("No tienes acceso");
}
$id=$_SESSION['ci'];
              $sql= "SELECT * FROM  CLASES WHERE Profesor=$id";
              $resultado=mysqli_query($conn,$sql);
              if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                  while($fila=mysqli_fetch_assoc($resultado)){
                    
                    $titulo=$fila['Materia'];
                    $curso=$fila['Grado'];
                   
                  }}


$ID_Clase = $_POST["CLASES_ID"];
$titulo = $_POST['titulo'];
$tema = !empty($_POST['tema_existente']) ? $_POST['tema_existente'] : $_POST['tema_nuevo'];
$descripcion = $_POST['descript'];
$fechaET = $_POST['fechE'];
$sobre = $_POST['sobre'];
$archivo = null;
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $destino = "media/" . basename($_FILES['archivo']['name']);
    if(move_uploaded_file($_FILES['archivo']['tmp_name'], $destino)){
        echo "Se guardó";
    }
    else{
        echo "no";
    }
    $archivo = $destino;
}

    $sql = "INSERT INTO TAREA (Titulo, Tema, Descripcion, FechaEntrega, CLASES_ID, Sobre, Archivo) 
         VALUES (?, ?, ?, ?, ?, ?, ?)";
      
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("ssssiss", $titulo, $tema, $descripcion, $fechaET, $ID_Clase, $sobre, $archivo);

         if ($stmt->execute()) {
     //header("Location: tablon_tareasProf.php?ID=$ID_Clase");
        exit();
    } else {
        echo "Error al registrar entrega: " . $stmt->error;
    }
    $stmt->close();

?>
