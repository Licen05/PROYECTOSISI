<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForwardSoft</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="CSS/inicioPR.css">
</head> 
<body class="bo">
    
      <?php
        include("bd.php");
?>
      <?php include("cabeza_profs.php");
            if ($_SESSION['rol']== 1) {
        header("Location: InicioES.php");
      } ?>

      
        <nav class ="tablon">
            
            <?php
              $id=$_SESSION['ci'];
              $sql= "SELECT * FROM  CLASES WHERE Profesor=$id";
              $resultado=mysqli_query($conn,$sql);
              if (!empty($resultado)&& mysqli_num_rows($resultado)>0) {
                  while($fila=mysqli_fetch_assoc($resultado)){
                    
                    $titulo=$fila['Materia'];
                    $curso=$fila['Grado'];
                    $ID_Clase = $fila["ID"];
                 
?>
                <div class="ger">
                      <h3 class="nam"><?=$titulo?></h3>
                      <h4 class="cat"><?=$curso?></h4>
                      <div class="editar"> <a href='clases_pr.php?ID=<?=$ID_Clase?>'><img src="FOTOS/ing.png" width="40px" ></img> </a> </div>
                      <div class="editar"> <a href='formEditClase.php?ID=<?=$ID_Clase?>'><img src="FOTOS/edit.png" width="40px" ></img> </a> </div>
                </div>
              
                     
              <?php }
              }
              else{
            ?>
            <nav class="ambos">
            <img class="conejo" src ="FOTOS/conejo.png">
            <h3 class="texto">TU TABLON ESTA VACIO</h3>
            
            <?php
            }
            ?>
            <div class="ajo">
              <a class="boton_unir" href="form_crearclase.php">CREA A UNA CLASE</a>
            
            <a class="boton_unir" href="form_unirme.php">UNETE A UNA CLASE</a>
          </div>
            
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