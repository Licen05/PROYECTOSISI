<?php
date_default_timezone_set('America/La_Paz');
        include("bd.php");
       

// Conexión a la base de datos
if (!isset($_SESSION['ci'])) {
    header("Location:FormSession.php");
    exit();
}

// Obtener datos de la clase actual
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
}?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>ForwardSoft</title>
    <link href="CSS/tablontareas.css"rel="stylesheet" type="text/css" />
    <link href="CSS/boton_eliminarPubli.css" rel="stylesheet" type="text/css" />
  <style>
    #dos{
        color:white;
    display: flex;
    align-items: center;
    flex-direction: column;
}


.ti{
    font-size: 70px;
}


table{
    width: 20em;
}
th, td {
  height: 50px;
  text-align: center;
  font-size: 12px;
  color: white;
  background-color: rgb(83, 104, 88);
}
td{
   width: 25%; 
   font-family: 'Questrial', sans-serif;
   font-size: 20px;
}
th {
  background-color: #35403E; /* color de fondo para cabecera */
  font-weight: bold;
  width: 39%;
}

td:hover {
  background-color: rgb(41, 43, 40); /* efecto al pasar el mouse */
  color: white;
}
.people{
    display: flex;
    color:white;
    align-items: center;
    justify-content:center;
    gap:50px;
    flex-wrap:wrap;
}
.caja{
    padding:15px;
    display: flex;
    align-items: center;
    gap:10px;
    border:0.4px solid white;
    border-radius: 10px;
}
.caja:hover {
    box-shadow: 0px 0px 5px 5px rgba(255, 255, 255, 0.2);
}
.ju{
    border:0px solid;
    border-radius: 100px;
}
</style>
    
   
</head>

<body class="clases_p">
    <header class="hea">
        <nav id="cabecera">
        <a href="clases_pr.php"><img class="out" src="FOTOS/au.png" width="50px"></a>
            <div class="imagen">
                <div class="titulo"><?= htmlspecialchars($titulo) ?></div>
                <div class="nombre_prof"><?= htmlspecialchars($curso) ?></div>
            </div>
        </nav>
    </header>

    <section id="uno">
        <div id="b_class">
        <?php include("botones_class.php");?>
        </div>
    </section>

   <section id="dos">
   
   <h2 class="ti">Profesores</h2>
                <div class="people">
                    <?php 
                    $datos = "SELECT Nombres , Apellidos, Curso,CI
                    FROM informacion 
                    INNER JOIN clases ON clases.Profesor = INFORMACION.CI  
                    WHERE clases.ID='$id_'";
                            $resul3=mysqli_query($conn,$datos);
                            
                    if (!empty($resul3)&& mysqli_num_rows($resul3)>0) {
                    while($fila3=mysqli_fetch_assoc($resul3)){
                        $nam=$fila3['Nombres'];
                        $apel=$fila3['Apellidos'];
                        $curs=$fila3['Curso'];
                    ?> 
                    <div class="caja">
                        <div><img src="FOTOS/usu.jpg" width="120px" class="ju"></div>
                        <table class="tabla_estu">
                            <tr> 
                                <th class="th_estu"> Nombres:</th>
                            
                                <td class="td_estu"> <?= htmlspecialchars($nam) ?> </td>
                            </tr>
                            <tr>
                                <th class="th_estu">Apellidos:</th>
                                <td class="td_estu">  <?= htmlspecialchars($apel) ?>  </td>
                            </tr>
                            <tr>
                                <th class="th_estu">Curso:</th>
                                <td class="td_estu"> <?= htmlspecialchars($curs) ?>  </td>
                            </tr>
                        </table>
                    </div>
                                <?php
                                }
                            }
    ?>   
                        
            </div>
            <h2 class="ti">Compañeros de Clase</h2>
                <div class="people">
                    <?php
                    $datos = "SELECT Nombres , Apellidos, Curso, CI
                    FROM informacion 
                    INNER JOIN clases_has_cuenta ON clases_has_cuenta.CUENTA_User = INFORMACION.CI 
                    WHERE clases_has_cuenta.CLASES_ID='$id_' ";
                            $resul=mysqli_query($conn,$datos);
                            
                    if (!empty($resul)&& mysqli_num_rows($resul)>0) {
                    while($fila2=mysqli_fetch_assoc($resul)){
                        $name=$fila2['Nombres'];
                        $apell=$fila2['Apellidos'];
                        $curso=$fila2['Curso'];
                    ?>
                    <div class="caja">
                        <div><img src="FOTOS/usu.jpg" width="120px" class="ju"></div>
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
                    </div>
                                <?php
                                }
                            }
    ?>   
                        
            </div>

    </section>
</div>  
        

<footer><?php include("footer.php"); ?>  </footer>    
</body>
</html>