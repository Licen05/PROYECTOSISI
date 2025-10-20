<?php
include("bd.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: index.php");
    exit();
}

// Verificamos el ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = intval($_GET['id']);

// Buscar imagen para eliminar del servidor
$sql = "SELECT Imagen FROM horario WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $rutaImagen = $row['Imagen'];

    // Borrar archivo físico si existe
    if (!empty($rutaImagen) && file_exists($rutaImagen)) {
        unlink($rutaImagen);
    }

    // Borrar registro de la base de datos
    $sqlDel = "DELETE FROM horario WHERE ID = ?";
    $stmtDel = $conn->prepare($sqlDel);
    $stmtDel->bind_param("i", $id);
    if ($stmtDel->execute()) {
        header("Location: horarios.php?msg=eliminado");
        exit();
    } else {
        echo "Error al eliminar horario.";
    }
    $stmtDel->close();
} else {
    echo "Horario no encontrado.";
}

$stmt->close();
$conn->close();
?>
