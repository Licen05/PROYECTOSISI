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
// recuperara rl nombre del usuario
$ci = $_SESSION['ci'] ?? '';
$autor = 'Usuario desconocido';

if (!empty($ci)) {
    $sql_nombre = "SELECT Nombres FROM informacion WHERE CI = '$ci'";
    $res_nombre = $conn->query($sql_nombre);
    if ($res_nombre && $res_nombre->num_rows > 0) {
        $autor = $res_nombre->fetch_assoc()['Nombres'];
    }
}

$contenido = $_GET['publi'] ?? '';
$asunta = $_GET['asunto'] ?? '';
$id_ = $_GET['id'] ?? '';

// Validación básica
if (empty($contenido) || empty($id_) || empty($asunta)) {
    echo "Faltan datos para guardar la publicación.<br>";
    echo "Contenido: " . $contenido . "<br>";
    echo "ID: " . $id_ . "<br>";
    echo "Asunto: " . $asunta . "<br>";
    exit();
}



$fechaActual = date("Y-m-d H:i:s");

// Insertar en la base de datos
$sql = "INSERT INTO publicaciones (Asunto, Texto, Fecha, CLASES_ID, Autor) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssis", $asunta, $contenido, $fechaActual, $id_, $autor);


if ($stmt->execute()) {
        if($_SESSION['rol']==1)
            header("Location:clases.php?ID=$id_");
        if($_SESSION['rol']==2)
            header("Location: clases_pr.php?ID=$id_");
        
    
    exit();
    
} else {
    echo "Error al insertar publicación: " . $conn->error;
}

$stmt->close();
$conn->close();
?>