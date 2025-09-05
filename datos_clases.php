<?php
session_start();
$_SESSION['nombre'] = $autor; // después de obtener el nombre


// Verificar si hay sesión activa
if (!isset($_SESSION['ci'])) {
    header("Location:FormSession.php");
    exit();
}

$ciAutor = $_SESSION['ci']; // o como se llame tu variable de sesión
$sql = "INSERT INTO publicaciones (Asunto, Texto, Fecha, CLASES_ID, Autor)
        VALUES ('$asunto', '$texto', NOW(), $clase_id, '$ciAutor')";


// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener nombre del usuario desde la tabla 'informacion'
$nombre = 'Usuario desconocido'; // Valor por defecto
$ci = $_SESSION['ci'];
$sql_nombre = "SELECT Nombres FROM informacion WHERE CI = ?";
$stmt_nombre = $conn->prepare($sql_nombre);
$stmt_nombre->bind_param("s", $ci);
$stmt_nombre->execute();
$result_nombre = $stmt_nombre->get_result();

if ($result_nombre && $result_nombre->num_rows > 0) {
    $nombre = $result_nombre->fetch_assoc()['Nombres'];
}
$stmt_nombre->close();

// Obtener datos del formulario
$_SESSION['nombre_usuario'] = $nombre;
$contenido = isset($_POST['publi']) ? $_POST['publi'] : '';
$asunto    = isset($_POST['asunto']) ? $_POST['asunto'] : '';
$clase_id  = isset($_POST['id']) ? intval($_POST['id']) : 0;
$archivo   = null;

$uploadDir = "media/"; 
$uploadOk = 1; 

if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $fileTmp = $_FILES['archivo']['tmp_name'];
    $fileName = basename($_FILES['archivo']['name']);
    $fileSize = $_FILES['archivo']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Nombre único: tarea + clase + timestamp
    $newFileName = "PUBLI-" . $ID_Clase . "-" . time() . "." . $fileType;
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
// Validación básica
if (empty($contenido) || empty($asunta) || empty($id_)) {
    echo "Faltan datos para guardar la publicación.";
    exit();
}
date_default_timezone_set('America/La_Paz');
$fechaActual = date("Y-m-d H:i:s");

// Insertar en la tabla 'publicaciones'
$sql = "INSERT INTO PUBLICACIONES (Autor, Asunto, Texto, Fecha, CLASES_ID, Archivo) 
         VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
      
    $stmt = $conn->prepare($sql);
   $stmt->bind_param("ssssis", $nombre, $asunta, $contenido, $fechaActual, $id_, $archivo);

         if ($stmt->execute()) {
    // Redirección según el rol
    if ($_SESSION['rol'] == 1)
        header("Location: clases.php?ID=$id_");
    elseif ($_SESSION['rol'] == 2)
        header("Location: clases_pr.php?ID=$id_");
    exit();
} else {
    echo "Error al insertar publicación: " . $stmt->error;
}
 
$stmt->close();
$conn->close();
?>
