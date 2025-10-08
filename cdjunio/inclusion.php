<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $asu=$_POST['nom'];
    $banana=$_POST['cometela'];
    $archivo= fopen('punto.txt','a');
    fwrite($archivo,$asu .PHP_EOL);
    fwrite($archivo,$banana .PHP_EOL);
    echo "<a href='archivos3.php'>Comentarios<a/> "
    ?>
    
</body>
</html>