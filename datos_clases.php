<?php
session_start();

// Verificar si hay sesión activa
if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

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

// Guardar en sesión el nombre
$_SESSION['nombre_usuario'] = $nombre;

// Obtener datos del formulario
$contenido = isset($_POST['publi']) ? trim($_POST['publi']) : '';
$asunto    = isset($_POST['asunto']) ? trim($_POST['asunto']) : '';
$clase_id  = isset($_POST['id']) ? intval($_POST['id']) : 0;

$archivo = null;
$uploadDir = "media/"; 
$uploadOk = 1;

// Subida de archivo si existe
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] == UPLOAD_ERR_OK) {
    $fileTmp  = $_FILES['archivo']['tmp_name'];
    $fileName = basename($_FILES['archivo']['name']);
    $fileSize = $_FILES['archivo']['size'];
    $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Nombre único: PUBLI-<clase>-timestamp.ext
    $newFileName = "PUBLI-" . $clase_id . "-" . time() . "." . $fileType;
    $targetFile  = $uploadDir . $newFileName;  // esto es lo que se guarda en BD (ruta relativa)

    // Validaciones
    if (file_exists(__DIR__ . "/" . $targetFile)) {
        echo "Lo sentimos, ya existe un archivo con ese nombre.";
        $uploadOk = 0;
    }
    if ($fileSize > 5 * 1024 * 1024) { // 5 MB
        echo "El archivo es demasiado grande.";
        $uploadOk = 0;
    }
    $extPermitidas = ["pdf","jpg","jpeg","png","gif","docx","xlsx","zip","txt"];
    if (!in_array($fileType, $extPermitidas)) {
        echo "Tipo de archivo no permitido.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($fileTmp, __DIR__ . "/" . $targetFile)) {
            // Guardamos la ruta relativa para mostrar en <img src="">
            $archivo = $targetFile; // ej: "media/PUBLI-3-1693948394.png"
        } else {
            echo "Error al subir el archivo.";
        }
    }
}


// Validación básica
if (empty($contenido) || empty($asunto) || empty($clase_id)) {
    echo "Faltan datos para guardar la publicación.";
    exit();
}

date_default_timezone_set('America/La_Paz');
$fechaActual = date("Y-m-d H:i:s");

// Insertar en la tabla 'publicaciones'
$sql = "INSERT INTO publicaciones (Autor, Asunto, Texto, Fecha, CLASES_ID, Archivo) 
        VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssis", $nombre, $asunto, $contenido, $fechaActual, $clase_id, $archivo);

if ($stmt->execute()) {
    // Redirección según el rol
    if ($_SESSION['rol'] == 1) {
        header("Location: clases.php?ID=$clase_id");
    } elseif ($_SESSION['rol'] == 2) {
        header("Location: clases_pr.php?ID=$clase_id");
    }
    exit();
} else {
    echo "Error al insertar publicación: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>

