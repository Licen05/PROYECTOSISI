<?php
    include("bd.php");?>
<!DOCTYPE html> 
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Alumno</title>

  <link href="CSS/tru.css" rel="stylesheet" type="text/css" />
  <style>
    .bienvenida{
      margin-top:20px;
      display: flex;
      flex-direction:column;
      justify-content:center;
    }
    .bienvenidos_texto{
      display: flex;
      flex-direction:column;
      text-align:center;
      font-size:40px;
    }
    .parrafo{
        display:flex;
        flex-direction:column;
      text-align:center;
      gap:50px;
      font-family:'Questrial', sans-serif ;
    }
    .bt{
        display:flex;
        flex-direction:row;
      justify-content:center;
      gap:20px;
    }
    .tp{
        display:flex;
        flex-direction:row;
      justify-content:right;
      gap:20px;
    }
    .ing{
        border: 0px solid;
        border-radius:13px;
      font-family:'Questrial', sans-serif ;
      background-color:#35403E;
      padding: 15px;
    }
    button{
        border: 0px solid;
        border-radius:13px;
      font-family:'Questrial', sans-serif ;
      background-color: #8ba39eff;
      gap:20px;
      padding: 10px;
    }
    </style>
</head>
 
<body class="gg">

  <header> 
        <?php
    include("encabezado.php");
    ?>
  </header> 
  <div class="cuerpo">
  <section class="b_izquierda"> <?php
    include("barra_iz.php");
?>
  </section>
  <section class="centro">
              <section class="bienvenida">
                        <h1 class="bienvenidos_texto">Centro de Cuentas</h1>
                        <aside class="parrafo">
                        <p>

<?php
$sql=  "SELECT * FROM INFORMACION";

$resultado = $conn->query($sql);
if($resultado->num_rows>0){ 
    while($fila=$resultado->fetch_assoc()){
        $CI_B= $fila['CI'];

        echo "<br>"."<br>".$fila['Nombres']." ".$fila['Apellidos']." ".$fila['Direccion']." ".$fila['Telefono']." ".$fila['Curso']." ".$fila['CI']." ".$fila['RUDE']." ".$fila['FechaNacimiento']."<br>";

        '<div class="tp">';
        echo "<button><a href='bloquear.php?CI=$CI_B' class='control'>Bloquear</a></button>";
        echo "<button><a href='Desbloquear.php?CI=$CI_B'class='control'>Desbloquear</a></button>"."<br>";
        '</div>';
    }
}

?>
<br><br>    <div class="bt">
<a class="ing" href="inicio.php">Tus Clases</a>
<a class="ing" href="cerrar.php">Cierra Sesion</a>
</div>
</p>
                        </aside>
              </section>
    </section> 
             
  <section class="b_derecha">
        <?php
        include("b_dere.php");
        ?>

  </section>
  </div>
</div>
        </div> 
</div>
        
</section>

        
  <?php
    include("footer.php");
    ?>
    
</body>

</html>

    