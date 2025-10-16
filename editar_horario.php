<?php
include("bd.php");
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 3) {
    header("Location: horarios.php");
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM horario WHERE ID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    die("Horario no encontrado.");
}
$horario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Editar Horario</title>
<link rel="stylesheet" href="CSS/inicio.css">
</head>
<body>
    <h2>Editar horario de <?= htmlspecialchars($horario['Dia']) ?></h2>
    <img src="<?= htmlspecialchars($horario['Imagen']) ?>" width="400" style="border-radius:10px;"><br><br>

    <form action="datos_horario.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="editar_id" value="<?= $horario['ID'] ?>">
        <label>Selecciona nueva imagen:</label><br>
        <input type="file" name="archivo" required><br><br>
        <button type="submit" name="accion" value="editar">Actualizar horario</button>
    </form>

    <br><a href="horarios.php">⬅️ Volver</a>
</body>
</html>
