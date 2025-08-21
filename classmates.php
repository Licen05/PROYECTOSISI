<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="CSS/cal.css" rel="stylesheet" type="text/css" />
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
$ID_Clase = $_GET['ID'] ;

$datos = "SELECT Nombres , Apellidos, Curso 
        FROM informacion 
        INNER JOIN clases ON clases.Profesor = INFORMACION.CI 
        WHERE clases.id='$ID_Clase' ";
                $resul=mysqli_query($conn,$datos);
                
                        if (!empty($resul)&& mysqli_num_rows($resul)>0) {
                        $fila2=mysqli_fetch_assoc($resul);
                        $name=$fila2['Nombres'];
                        $apell=$fila2['Apellidos'];
                        $curso=$fila2['Curso'];
                        }
    ?>

    
    <header class="hea">
        <a href='clases.php?ID=<?=$ID_Clase?>'><img class="out" src="FOTOS/au.png" width="50px"></a>
        <div class="imagen">
                <div class="titulo"><?= htmlspecialchars($titulo) ?></div>
                <div class="nombre_prof"><?= htmlspecialchars($curso) ?></div>
            </div>
        </nav>
    </header>

                        <div class="dos">
                                        <h2 class="ti">Compañeros de Clase</h2>
                                        <div class="people">
                                                    <div><img src="FOTOS/usu.jpg" width="200px"></div>
                                                <table class="tabla_estu">
                                                        <tr> 
                                                            <th class="th_estu"> Nombres:</th>
                                                        
                                                            <td class="td_estu"> <?= htmlspecialchars($name) ?> </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="th_estu">Apellidos:</th>
                                                            <td class="td_estu">  <?= htmlspecialchars($apell) ?>  </td>
                                                        </tr>
                                                        <tr>
                                                            <th class="th_estu">Curso:</th>
                                                            <td class="td_estu"> <?= htmlspecialchars($curso) ?>  </td>
                                                        </tr>
                                                    </table>
                                        <div>
                        </div>
                    </div>

<footer class="fo">
    <?php include("footer.php");?>
</footer>
</body>
</html>