<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    include("bd.php");
$sql=  "SELECT * FROM INFORMACION";

$resultado = $conn->query($sql);
if($resultado->num_rows>0){
    while($fila=$resultado->fetch_assoc()){
        $CI_B= $fila['CI'];
        echo $fila['Nombres']." ".$fila['Apellidos']." ".$fila['Direccion']." ".$fila['Telefono']." ".$fila['Curso']." ".$fila['CI']." ".$fila['RUDE']." ".$fila['FechaNacimiento']."<br>";

        
        echo "<button><a href='bloquear.php?CI=$CI_B'>Bloquear</a></button>"."<br>";
        echo "<button><a href='Desbloquear.php?CI=$CI_B'>Desbloquear</a></button>"."<br>";
    }
}

?>
</body>
</html>