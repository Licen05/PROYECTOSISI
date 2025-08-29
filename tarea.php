<?php
// tarea.php

// Iniciar sesión
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el usuario inició sesión
if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}

// Conectar a la BD
$conexion = new mysqli("localhost", "root", "", "proyectosisi");

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// ---- PARCHE para IDs flexibles ----
$claseParam = $_GET['ID'] ?? $_GET['id'] ?? null;
if ($claseParam === null || !preg_match('/^\d+$/', (string)$claseParam)) {
    die("ID de clase no válido.");
}
$idClase = (int)$claseParam;

// --- Eliminar tarea ---
if (isset($_GET['eliminar'])) {
    $idEliminar = intval($_GET['eliminar']);

    $sqlDelete = "DELETE FROM TAREA WHERE id = ? AND CLASES_ID = ?";
    $stmt = $conexion->prepare($sqlDelete);
    $stmt->bind_param("ii", $idEliminar, $idClase);

    if ($stmt->execute()) {
        header("Location: tarea.php?id=" . $idClase);
        exit();
    } else {
        echo "Error al eliminar: " . $stmt->error;
    }
}

// --- Consultar tareas de la clase ---
$sql = "SELECT * FROM TAREA WHERE CLASES_ID = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $idClase);
$stmt->execute();
$resultado = $stmt->get_result();

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tareas de la clase</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #f2f2f2; }
        a { text-decoration: none; color: red; }
    </style>
</head>
<body>
    <h2 style="text-align:center;">Lista de tareas</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Título</th>
            <th>Descripción</th>
            <th>Tema</th>
            <th>Nota Base</th>
            <th>Fecha de Entrega</th>
            <th>Acciones</th>
        </tr>
        <?php while ($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?php echo $fila['id']; ?></td>
                <td><?php echo $fila['Titulo']; ?></td>
                <td><?php echo $fila['Descripcion']; ?></td>
                <td><?php echo $fila['Tema']; ?></td>
                <td><?php echo $fila['Sobre']; ?></td>
                <td><?php echo $fila['FechaEntrega']; ?></td>
                <td>
                    <a href="tarea.php?id=<?php echo $idClase; ?>&eliminar=<?php echo $fila['id']; ?>" onclick="return confirm('¿Seguro que deseas eliminar esta tarea?');">Eliminar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
