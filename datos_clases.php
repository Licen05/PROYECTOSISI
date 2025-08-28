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
$contenido = isset($_GET['publi']) ? $_GET['publi'] : '';
$asunta = isset($_GET['asunto']) ? $_GET['asunto'] : '';
$id_ = isset($_GET['id']) ? $_GET['id'] : '';

// Validación básica
if (empty($contenido) || empty($asunta) || empty($id_)) {
    echo "Faltan datos para guardar la publicación.";
    exit();
}
date_default_timezone_set('America/La_Paz');
$fechaActual = date("Y-m-d H:i:s");

// Insertar en la tabla 'publicaciones'
$sql = "INSERT INTO publicaciones (Autor, Asunto, Texto, Fecha, CLASES_ID) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $nombre, $asunta, $contenido, $fechaActual, $id_);

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