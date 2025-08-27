<?php
session_start();



// Verificar si hay sesión activa
if (!isset($_SESSION['ci'])) {
    header("Location:FormSession.php");
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

// Obtener datos del formulario

$nota = isset($_POST['nota']) ? $_POST['nota'] : '';
$id_ = isset($_POST['idt']) ? $_POST['idt'] : '';
$id_user = isset($_POST['id']) ? $_POST['id'] : '';


// Validación básica
if (empty($nota) ) {
    echo "Faltan datos para guardar la publicación.";
    exit();
}
date_default_timezone_set('America/La_Paz');
$fechaActual = date("Y-m-d H:i:s");

// Insertar en la tabla 'publicaciones'
$sql = "INSERT INTO entrega (CUENTA_User, Nota, FechaEnvio, Tarea_id) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iisi", $id,  $nota, $fechaActual, $id_);

if ($stmt->execute()) {
    // Redirección según el rol
    if ($_SESSION['rol'] == 2)
        header("Location: revisar.php?=$id_");
    exit();
} else {
    echo "Error al insertar publicación: " . $stmt->error;
}
 
$stmt->close();
$conn->close();
?>