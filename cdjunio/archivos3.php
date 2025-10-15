<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div{
            background-color: blue;
            font-family: array_intersect_assoc;
            box
        }
    </style>
</head>
<body>
    <?php 
    $a=fopen("punto.txt","r");
    while(!feof($a)){
        $leer=fgets($a);
        $ver=nl2br($leer);
        echo 
        "<div>".$ver."</div>";

    }

    ?>
</body>
</html>