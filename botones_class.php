<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="CSS/clases_p.css"rel="stylesheet" type="text/css" />
    <link href="CSS/boton_eliminarPubli.css" rel="stylesheet" type="text/css" />
    <style>
        .texto{
            color:white;
            padding-left:20px;
        }
        .pu{
            border: 1px solid white;
            border-radius: 15px;
            width: 99%;
        }
        .imagen{
            margin-top:10px;
            display:flex;
            flex-direction:column;
            justify-content: right;
        }
        
.nombre{
    font-size: 40px;
    color: white;
}

.titulo {
  font-size: 100px;
  color: rgb(255, 255, 255);
  
}

        </style>
</head>
<body>
                    <?php  
                        $id_ = $_GET['ID'] ;  
                        if ($_SESSION['rol'] == 1) {
                            $linkTarea = "tablon_tareas.php?ID=$id_";
                        } elseif ($_SESSION['rol'] == 2) {
                            $linkTarea = "tablon_tareasProf.php?ID=$id_";
                        } else {
                            $linkTarea = "#"; 
                        }
                        ?>
                    <a href="<?= $linkTarea ?>" class="cuadros" id="tarea">
                    <div id="pendientes" class="enlaces">
                             TAREAS
                        <img src="FOTOS/tare.png" id="tare">
                    </div>
                    </a>

                     <?php  
                        $id_ = $_GET['ID'] ;  
                        if ($_SESSION['rol'] == 1) {
                            $linkTarea = "classma.php?ID=$id_";
                        } elseif ($_SESSION['rol'] == 2) {
                            $linkTarea = "classma.php?ID=$id_";
                        } else {
                            $linkTarea = "#"; 
                        }
                        ?>
                    <a href="<?= $linkTarea ?>" class="cuadros" id="tarea">
                    <div id="pendientes" class="enlaces">
                             PERSONAS
                        <img src="FOTOS/person.png" id="person">
                    </div>
                    </a>

                        <?php  
                        $id_ = $_GET['ID'] ;  
                        if ($_SESSION['rol'] == 1) {
                            $linkTarea = ".php?ID=$id_";
                        } elseif ($_SESSION['rol'] == 2) {
                            $linkTarea = ".php?ID=$id_";
                        } else {
                            $linkTarea = "#"; 
                        }
                        ?>
                    <a href="<?= $linkTarea ?>" class="cuadros">
                    <div id="archivos"  class="enlaces">
                        ARCHIVOS
                        <span id="archiv2"><img src="FOTOS/archiv.png" id="archiv"></span>
                    </div>
                    </a>
                    
                    <?php  
                        $id_ = $_GET['ID'] ;  
                        if ($_SESSION['rol'] == 1) {
                            $linkTarea = "clases.php?ID=$id_";
                        } elseif ($_SESSION['rol'] == 2) {
                            $linkTarea = "clases_pr.php?ID=$id_";
                        } else {
                            $linkTarea = "#"; 
                        }
                        ?>
                    <a href="<?= $linkTarea ?>" class="cuadros">
                    <div id="publi"  class="enlaces">
                        PUBLICACIONES
                        <span id="archiv2"><img src="FOTOS/flecha.png" id="archiv"></span>
                    </div>
                    </a>


</body>
</html>
                    