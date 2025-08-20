<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="CSS/clases.css" rel="stylesheet" type="text/css" />
    <style>
       @import url('https://fonts.googleapis.com/css2?family=Graduate&family=Questrial&display=swap');

div {
  font-family: 'Graduate', serif;
  margin: 0px;
   
}
header{
    display: flex;
    flex-direction: column;

}
.imagen{
    display: flex;
    align-items:center;
    justify-content:space-between;
    padding:60px;
}
    </style>
</head>
<body>
    <?php
    include("bd.php");
    if($_SESSION['rol']==2)
            header("Location:inicioPR.php");
// Conexión a la base de datos
    date_default_timezone_set('America/La_Paz');

if (!isset($_SESSION['ci'])) {
    header("Location:FormSession.php");
    exit();
}
if (!isset($_GET['ID']) || !is_numeric($_GET['ID'])) {
    die("ID de clase no válido.");
}

$id = intval($_GET['ID']);
$sql = "SELECT * FROM CLASES WHERE ID = $id";
$resultado = $conn->query($sql);

if ($resultado && $resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();
    $titulo = $fila['Materia'];
    $curso = $fila['Grado'];
} else {
    die("Clase no encontrada.");
}


    ?>
    <header class="hea">
        <a href="inicioES.php"><img class="out" src="FOTOS/out.png" width="50px"></a>
        <div class="imagen">
                <div class="titulo"><?= htmlspecialchars($titulo) ?></div>
                <div class="nombre_prof"><?= htmlspecialchars($curso) ?></div>
            </div>
        </nav>
    </header>
</body>
</html>