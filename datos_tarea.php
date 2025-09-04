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

$uploadDir = "media/"; 
$uploadOk = 1; 

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['archivo']['tmp_name'];
    $fileName = basename($_FILES['archivo']['name']);
    $fileSize = $_FILES['archivo']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Nombre único: tarea + clase + timestamp
    $newFileName = "TAREA-" . $ID_Clase . "-" . time() . "." . $fileType;
    $targetFile = $uploadDir . $newFileName;

    // Validar si existe
    if (file_exists($targetFile)) {
        echo "Lo sentimos, ya existe un archivo con ese nombre.";
        $uploadOk = 0;
    }

    // Validar tamaño (5MB)
    if ($fileSize > 5 * 1024 * 1024) {
        echo "El archivo es demasiado grande.";
        $uploadOk = 0;
    }

    // Validar extensión
    $extPermitidas = ["pdf","jpg","jpeg","png","gif","docx","xlsx","zip","txt"];
    if (!in_array($fileType, $extPermitidas)) {
        echo "Tipo de archivo no permitido.";
        $uploadOk = 0;
    }

    // Subir si todo ok
    if ($uploadOk == 1) {
        if (move_uploaded_file($fileTmp, $targetFile)) {
            $archivo = $targetFile;
        } else {
            echo "Error al subir el archivo.";
        }
    }
}
    $sql = "INSERT INTO TAREA (Titulo, Tema, Descripcion, FechaEntrega, CLASES_ID, Sobre, Archivo) 
         VALUES (?, ?, ?, ?, ?, ?, ?)";
      
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("ssssiss", $titulo, $tema, $descripcion, $fechaET, $ID_Clase, $sobre, $archivo);

         if ($stmt->execute()) {
    header("Location: tablon_tareasProf.php?ID=$ID_Clase");
    exit();
} else {
    echo "Error al registrar tarea: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>
