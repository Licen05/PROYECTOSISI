<?php
session_start();

if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

// Verifica si se recibió el ID de la publicación
if (!isset($_POST['idt']) || !is_numeric($_POST['idt'])) {
    die("ID de tarea no válido.");
}

$idt = intval($_POST['idt']);

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Primero obtener el CLASES_ID antes de eliminar
$sqlPostTarea = "SELECT CLASES_ID FROM TAREA WHERE id=?";
$stmtPost = $conn->prepare($sqlPostTarea);
$stmtPost->bind_param("i", $idt);
$stmtPost->execute();
$result = $stmtPost->get_result();

if ($result->num_rows > 0) {
    $clase = $result->fetch_assoc()['CLASES_ID'];
    $stmtPost->close();
    
    $sqlCheck = "SELECT COUNT(*) as total FROM ENTREGA WHERE Tarea_id = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("i", $idt);
$stmtCheck->execute();
$resultCheck = $stmtCheck->get_result()->fetch_assoc();
   $stmtCheck->close();

if ($resultCheck['total'] > 0) {
    die("No se puede eliminar la tarea porque tiene entregas asociadas.");
}


    // Ahora eliminar la publicación
    $sql = "DELETE FROM TAREA WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idt);

    
    if ($stmt->execute()) {
        header("Location: tablon_tareasProf.php?ID=$clase");
        exit();
    } else {
        echo "Error al eliminar la Tarea: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se encontró la tarea.";
}

$conn->close();
?>
