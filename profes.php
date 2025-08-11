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

    $entrada = "$id_comentario|$fecha|$autor|$contenido" . PHP_EOL;
    file_put_contents($archivo, $entrada, FILE_APPEND);
}


?>
<!DOCTYPE html> 
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Alumno</title>

  <link href="CSS/tru.css" rel="stylesheet" type="text/css" />
  <style>
    table {
      width: 70%;
      border-collapse: collapse;
    }
    th, td {
      border: 2px solid white;
      vertical-align: center;
    }
    th {
      background-color: gray;
      text-align: center;
    }
    td:first-child {
        color:white;
    }
    .parrafo{
        display: flex;
        flex-direction:column;
        justify-content: center;
        align-items:center;
    }
    .bienvenidos_texto{
    background-color: rgba(255, 255, 255);
    color:rgba(53, 64, 62);
    padding:5px ;
    margin: 10px 25px 50px 25px;
}
.bienvenida{
    display: flex;
    flex-direction: column;
    justify-content:center;
    margin: 10px 10px 10px 10px;
    background-color: rgba(53, 64, 62, 0.6);
    color:white;
    padding:15px;
}
@media (max-width: 1900px) {
.bienvenida{
    display: flex;
    flex-direction: column;
    justify-content:center;
    margin: 80px 10px 10px 10px;
}}
@media (max-width: 790) {
.bienvenida{
    display: flex;
    flex-direction: column;
    justify-content:center;
    margin: 100px 10px 10px 10px;
}}
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
                        <h1 class="bienvenidos_texto">DOCENTES DE LA INSTITUCIÓN</h1>
                        <aside class="parrafo">
                          <table>
                            <tr>
      <th>PLANTEL</th>
      <th>NOMBRES</th>
    </tr>
    <tr>
      <td>DIRECTORA</td>
      <td>
        Garcia Terrazas<br>Tania Garcia
      </td>
    </tr>
    <tr>
      <td>SECRETARIA</td>
      <td>
        Angulo Alvarez <br> Elizabeth
      </td>
    </tr>
    <tr>
      <td>ASISTENTE</td>
      <td>
        Diaz Salinas <br> Fanny
      </td>
    </tr>
    <tr>
      <td>PORTERA</td>
      <td>
        Estevez Perez <br> Rosaura
      </td>
    </tr>
                          </table><br>
                         <table>
    <tr>
      <th>GRADO</th>
      <th>DOCENTES</th>
    </tr>
    <tr>
      <td>PRIMERO A</td>
      <td>
        Prof. Jorge Mareño<br>
        Prof. Ana Maria Leyton
      </td>
    </tr>
    <tr>
      <td>PRIMERO B</td>
      <td>
        Prof. Geraldine Ledezma<br>
        Prof. Luis Quiroz
      </td>
    </tr>
    <tr>
      <td>SEGUNDO A</td>
      <td>
        Prof. Iby Sainz<br>
        Prof. Jenny Camacho
      </td>
    </tr>
    <tr>
      <td>SEGUNDO B</td>
      <td>
        Prof. Arnold Choque<br>
        Prof. Cinthia Condori
      </td>
    </tr>
    <tr>
      <td>TERCERO A</td>
      <td>
        Prof. Magaly Claros
      </td>
    </tr>
    <tr>
      <td>TERCERO B</td>
      <td>
        Prof. Janny Heredia<br>
        Prof. Jose Tejerina
      </td>
    </tr>
    <tr>
      <td>TERCERO C</td>
      <td>
        Prof. Roxana Montecinos<br>
        Prof. Daysi Pucumani
      </td>
    </tr>
    <tr>
      <td>CUARTO A</td>
      <td>
        Prof. Fabiola Olivera<br>
        Prof. Mario Ortega
      </td>
    </tr>
    <tr>
      <td>CUARTO B</td>
      <td>
        Prof. Eugenio Parra<br>
        Prof. Rosalia Ramirez
      </td>
    </tr>
    <tr>
      <td>CUARTO C</td>
      <td>
        Prof. Lilian Soto<br>
        Prof. Elvis Salvatierra
      </td>
    </tr>
    <tr>
      <td>QUINTO A</td>
      <td>
        Prof. Tania Quispe<br>
        Prof. Freddy Aguilar
      </td>
    </tr>
    <tr>
      <td>QUINTO B</td>
      <td>
        Prof. Luis Bustamante<br>
        Prof. Tania Ustariz
      </td>
    </tr>
    <tr>
      <td>QUINTO C</td>
      <td>
        Prof. Cristina Tardio<br>
        Prof. Ramon Escalier
      </td>
    </tr>
    <tr>
      <td>SEXTO A</td>
      <td>
        Prof. Vladimir Alcocer<br>
        Prof. Martha Zubieta
      </td>
    </tr>
    <tr>
      <td>SEXTO B</td>
      <td>
        Prof. Mirian Trujillo<br>
        Prof. Oscar Cruz
      </td>
    </tr>
    <tr>
      <td>SEXTO C</td>
      <td>
        Prof. Victor Tapia
      </td>
    </tr>
  </table>
                        </aside>
                        <h1 class="bienvenidos_texto">MATRÍCULAS</h1>
                        <aside class="parrafo">
                        <p>El archivo no esta disponible por el momento.</p>
                        </aside>
              </section>
    </section> 
             
  <section class="b_derecha">
        <div class="barra_acceso">
            <h2 class="titulo_acceso_online">Acceso Online</h2>
            <div class="tj">
            <a class="ingreso" href="FormSession.php">Ingresa</a></div>
        </div>
            <h2 class="cale">Calendario
            </h2>
        <div class="tj">
            <img class="cal_img" src="FOTOS/calendario.jpg">
        </div>
        <div >
            <h2 class="barra_redes">Comentarios</h2>
            <div >
            <section id="dos">
  
<?php
include("comentarios.php");
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
