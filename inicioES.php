<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="CSS/in_vacioEstu.css">
</head>
<body class="bo">
<?php
include("bd.php");
?>

<?php include("cabeza.php"); ?>
    
                <nav class ="tablon">
                              <?php 
                                $id=$_SESSION['ci'];
                                $sql= "SELECT * FROM  CLASES_HAS_CUENTA WHERE CUENTA_User=$id";
                                $resultado=mysqli_query($conn,$sql);
                                if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                                    while($fila=mysqli_fetch_assoc($resultado)){
                                     $idClase=$fila['CLASES_ID'];
                                      
                          $sql2= "SELECT * FROM  CLASES WHERE ID=$idClase";
                                      $resultado2=mysqli_query($conn,$sql2);
                                      if (!empty($resultado2)&& mysqli_num_rows($resultado2)>0) {
                                        $fila2=mysqli_fetch_assoc($resultado2);
                                        $ID_Clase = $fila2["ID"];
                                        $titulo=$fila2['Materia'];
                                        $curso=$fila2['Grado'];
                                ?>
                                <div class="ger">
                                        <h3 class="nam"><?=$titulo?></h3>
                                        <h4 class="cat"><?=$curso?></h4>
                                            <div class="editar"> <a href='clases.php?ID=<?=$ID_Clase?>'><img src="FOTOS/ing.png" width="40px" ></img> </a> </div>
                                  </div>
                                <?php
                                      }
                                    }

                                }
                                else{
                              ?>
                              <nav class="ambos">
                              <img class="conejo" src ="FOTOS/conejo.png">
                              <h3 class="texto">TU TABLÓN ESTÁ VACÍO</h3>
                              
                              <?php
                              }
                              ?>
                              <a class="boton_unir" href="form_unirme.php" >ÚNETE A UNA CLASE</a>
                    </nav>
                </nav>
                
                
  </div>
   <?php include("footer.php"); ?> 
 

<script>
    function toggleMenu() {
      document.getElementById("dropdown").classList.toggle("mostrar");
    }

    // Cerrar el menú si se hace clic fuera de él
    window.onclick = function(event) {
      if (!event.target.matches('.menu-boton')) {
        var dropdowns = document.getElementsByClassName("menu-contenido");
        for (var i = 0; i < dropdowns.length; i++) {
          var abierto = dropdowns[i];
          if (abierto.classList.contains('mostrar')) {
            abierto.classList.remove('mostrar');
          }
        }
      }
    }
  </script>

</body>
</html>