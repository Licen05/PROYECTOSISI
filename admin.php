<?php
include("bd.php");

// Obtener nombre del usuario desde la base de datos usando su CI
$autor = 'Usuario desconocido';
if (isset($_SESSION['ci'])) {
    $ci = $_SESSION['ci'];
    $sql_nombre = "SELECT Nombres FROM informacion WHERE CI = '$ci'";
    $res_nombre = $conn->query($sql_nombre);
    if ($res_nombre && $res_nombre->num_rows > 0) {
        $autor = $res_nombre->fetch_assoc()['Nombres'];
    }
}

// Guardar comentario principal
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comen'])) {
    $contenido = trim($_POST['comen']);
    date_default_timezone_set('America/La_Paz');
    $fecha = date("Y-m-d H:i:sa");
    $id_comentario = uniqid();

    $archivo = "comentarios.txt"; // define tu archivo
    $entrada = "$id_comentario|$fecha|$autor|$contenido" . PHP_EOL;
    file_put_contents($archivo, $entrada, FILE_APPEND);
}

// Verificar sesión activa
if (!isset($_SESSION['ci'])) {
    header("Location: FormSession.php");
    exit();
}
?>

<!DOCTYPE html> 
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Administrador</title>

  <link href="CSS/encabezado.css" rel="stylesheet" type="text/css" />
  <link href="CSS/admin.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <style>
    .bienvenida {
      margin-top: 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .bienvenidos_texto {
      display: flex;
      flex-direction: column;
      text-align: center;
      font-size: 40px;
    }
    .parrafo {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      text-align: center;
      gap: 50px;
      font-family: 'Questrial', sans-serif;
    }
    .bt {
      display: flex;
      flex-direction: row;
      justify-content: center;
      gap: 20px;
    }
    .ing {
      border: 0;
      border-radius: 13px;
      font-family: 'Questrial', sans-serif;
      background-color: #35403E;
      padding: 15px;
      color: white;
      text-decoration: none;
    }
    a{
      
      color:white;
    }
    .dao {
      display: flex;
      align-items: center;
    }
    
    .tp {
      display: flex;
      flex-direction: row;
      justify-content: center;
      gap: 20px;
    }
    .sus{
      border: 2px solid  #ccc;;   
      padding: 10px;
      border-radius: 10px;
    display: flex;
      flex-direction: column;
      gap:15px;
    }
      
    .tabla_estu {
      margin: 10px auto;
      border-collapse: collapse;
    }
    .tabla_estu th, .tabla_estu td {
      border: 1px solid #ccc;
      padding: 3px;
    }
    .control{
      display: flex;
      justify-content: center;
      align-items: center;
      border: 0;
      border-radius: 13px;
      font-family: 'Questrial', sans-serif;
      background-color: #8ba39e;
      padding: 10px;
      width: 20%;
    }
  </style>
</head>

<body class="gg">

<header> 
  <?php include("encabezado.php"); ?>
</header>

<div class="cuerpo">  
  <section class="centro">
    <section class="bienvenida">
      <h1 class="bienvenidos_texto">Centro de Cuentas</h1>

<br><br>
      <aside class="parrafo">
        <?php
        $sql = "SELECT * FROM INFORMACION";
        $resultado = $conn->query($sql);

        if ($resultado && $resultado->num_rows > 0) {
          while ($fila = $resultado->fetch_assoc()) {
            $CI_B = $fila['CI'];
            $nom = $fila['Nombres'];
            $ape = $fila['Apellidos'];
            $dire = $fila['Direccion'];
            $tel = $fila['Telefono'];
            $cur = $fila['Curso'];
            $ru = $fila['RUDE'];
            $naci = $fila['FechaNacimiento'];

            $sql45 = "SELECT * FROM CUENTA WHERE User = '$CI_B'";
            $resultado34 = $conn->query($sql45);

            if ($resultado34 && $resultado34->num_rows > 0) {
              while ($fila5 = $resultado34->fetch_assoc()) {
                $rol = $fila5['Rol'];
                $blo = $fila5['Bloqueado'];
        ?>
        <div class="sus">
        <div class="dao">
          <div><img src="FOTOS/usu.jpg" width="200px"></div>
          <table class="tabla_estu">
            <tr> 
              <th class="ti">Nombres:</th>
              <td class="tu"><?= htmlspecialchars($nom) ?></td>
            </tr>
            <tr>
              <th class="ti">Apellidos:</th>
              <td class="tu"><?= htmlspecialchars($ape) ?></td>
            </tr>
            <tr>
              <th class="ti">Dirección:</th>
              <td class="tu"><?= htmlspecialchars($dire) ?></td>
            </tr>
            <tr>
              <th class="ti">Curso:</th>
              <td class="tu"><?= htmlspecialchars($cur) ?></td>
            </tr>
            <tr>
              <th class="ti">RUDE:</th>
              <td class="tu"><?= htmlspecialchars($ru) ?></td>
            </tr>
            <tr>
              <th class="ti">CI:</th>
              <td class="tu"><?= htmlspecialchars($CI_B) ?></td>
            </tr>
            <tr>
              <th class="ti">Fecha de Nacimiento:</th>
              <td class="tu"><?= htmlspecialchars($naci) ?></td>
            </tr>
            <tr>
              <th class="ti">Rol de cuenta:</th>
              <td class="tu">
                <?php
                if ($rol == 2) {
                    echo "Profesor";
                } elseif ($rol == 1) {
                    echo "Estudiante";
                } elseif ($rol == 3) {
                    echo "Administrador";
                }
                ?>
              </td>
            </tr>
            <tr>
              <th class="ti">Estado de cuenta:</th>
              <td class="tu">
                <?php
                if ($blo == 1) {
                    echo "Bloqueada";
                } else {
                    echo "Activa";
                }
                ?>
              </td>
            </tr> 
          </table>
        </div>

        <div class="tp">
          <?php 
            echo "<a href='bloquear.php?CI=$CI_B' class='control'>Bloquear</a>";
            echo "<a href='Desbloquear.php?CI=$CI_B' class='control'>Desbloquear</a>";
            echo "<a href='CambiarEstu.php?CI=$CI_B' class='control'>Rol Estudiante</a>";
            echo "<a href='CambiarProf.php?CI=$CI_B' class='control'>Rol Profesor</a>";
          ?>
        </div>
              </div>
        <?php
              } // cierre while CUENTA
            } // cierre if CUENTA
          } // cierre while INFORMACION
        } // cierre if INFORMACION
        ?>
      </aside>
    </section>
  </section>

  <section class="b_derecha">
    <?php include("b_dere.php"); ?>
  </section>
</div>

<?php include("footer.php"); ?>

</body>
</html>

