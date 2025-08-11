<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .comen{
            color:white;
        }
    </style>
</head>
<body>
    
<div class="caja_comentario"> 
   <div class="texto_comentario"> 

   <form  method="post">
    <div class="seh"><p for="" class="comen">Comenta una reseña....</p><img src="FOTOS/burbuja.png" id="burbuja" width="50px" height="50px"></div>
    <div class="seh"><textarea name="comen" id="" cols="40" rows="2"> </textarea>   
    <button type="submit" value="" class="bet"><img src="FOTOS/flecha.png"></button></div>
    </form>
    
   </div>
        </div> 

<div class="scro">
<?php
    date_default_timezone_set('America/La_Paz');
if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $lineas = array_reverse($lineas);

    // Cargar respuestas
    $respuestas = [];
    if (file_exists($archivo_respuestas)) {
        $res = file($archivo_respuestas, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($res as $r) {
            list($comentario_id, $fecha_r, $autor_r, $contenido_r) = explode('|', $r);
            $respuestas[$comentario_id][] = [
                'fecha' => $fecha_r,
                'autor' => $autor_r,
                'contenido' => $contenido_r
            ];
        }
    }

    foreach ($lineas as $linea) {
        list($id, $fecha, $autor, $contenido) = explode('|', $linea);
        echo '
        
        <div class="caja_comentario_2">
            <div class="ty">
                <img src="FOTOS/user.png" id="user" height="40px" width="40px">
                <p class="datos_profe">' . htmlspecialchars($autor) . '</p>
            </div>
            <input type="datetime-local" class="datos_profe" value="' . date("Y-m-d\TH:i", strtotime($fecha)) . '" readonly>
            <div class="respuesta">' . htmlspecialchars($contenido) . 
            '</div>
        </div>'
            ;
            
     
    }
} else {
    echo '<p class="comen">No hay publicaciones aún.</p>';
}
?>

</body>
</html>
