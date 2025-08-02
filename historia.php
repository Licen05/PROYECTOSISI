<?php
session_start();

$archivo = 'mensajes.txt';
$archivo_respuestas = 'respuestas.txt';

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyectoSISI"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

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
    $fecha = date("Y-m-d H:i:s");
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
    
.bienvenida{
    display: flex;
    flex-direction: column;
    justify-content:center;
    margin: 10px 10px 10px 10px;
    background-color: rgba(53, 64, 62, 0.6);
    color:white;
    padding:15px;
}

.parrafo{
  font-family: 'Questrial', sans-serif;
  text-align : center;
  font-size:16px;
    background-color: rgba(53, 64, 62, 0.6);
    padding: 10px;
}
.bienvenidos_texto{
    background-color: rgba(255, 255, 255);
    color:rgba(53, 64, 62);
    padding:5px ;
    margin: 10px 25px 50px 25px;
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
  <section class="b_izquierda">
  <nav class="barra_izq"> 
        <a href="inicio.php"><img src="FOTOS/logo_casa.png" class="casa"></a>

        <h2 class="nom">Menú</h2>

        <div class="men" >
            <div class="sub">
                <div class="no"><h3 class="di">Horario de Clases</h3> </div>
            <div class="no"><h3 class="di">Calendario</h3></div>  
            <div class="no"><h3 class="di">Profesores</h3> </div>
            <div class="no"><h3 class="di">Guias de Curso</h3> </div>
            <div class="no"><h3 class="di">Himno al Colegio</h3></div>
            </div>
        </div>

          <h2 class="nam">Noticias</h2>
          
        <div class="noti">
            <div class="sub">
            <div class="no"><h3 class="di">Inicio de año Escolar</h3></div>
            <div class="no"><h3 class="di">Requisitos para <br> Matricularse</h3></div>
            <div class="no"><h3 class="di">Matriculas</h3></div>
            <div class="no"><h3 class="di">Inscripciones</h3></div>
            </div>
        </div>
        
        <h2>Visitas</h2>
        <aside class="tabla">
            <div class="visi">
                <table>
  <thead>
    <tr>
      <th>HOY</th>
      <th>ESTE MES</th>
      <th>MES PASADO</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>4</td>
      <td>55</td>
      <td>230</td>
    </tr>
  </tbody>
</table>
            </div>
        </aside>
    </nav>
    
  </section>
  <section class="centro">
              <section class="bienvenida">
                        <h1 class="bienvenidos_texto">RESEÑA HISTOGRÁFICA</h1>
                        <aside class="parrafo">
                        <p>El colegio se fundó el 8 de Mayo del año 1969  en instalaciones del colegio Abaroa , <br>
                        posteriormente fue trasladado a la vivienda donde funciona actualmente la DDE, posteriormente se <br>
                        trasladó a la ex barraca de la empresa Johansson ubicado en la calle Ecuador entre Hamiraya y Junín, <br>
                        en condiciones nada adecuadas tuvieron que acomodarse porque eran ambientes muy pequeños, <br>se contaba
                         con más de 200 estudiantes varones; por último el colegio  se ubicó en la calle Ecuador <br>entre Hamiraya
                          y Junín y el año 1978 a solicitud de los padres de familia el colegio se volvió mixto hasta la <br>
                          actualidad. A través de los años el colegio fue progresando y la Unidad Educativa “Rene Barrientos <br>
                          Ortuño A” surgió como una necesidad de responder a los grandes exigencias de ofrecer a los jóvenes <br>
                          estudiantes una educación  integral, inclusiva, que permita mejores condiciones para el futuro <br>
                          y progreso de las familias, de la sociedad y por ende del país, en la actualidad cuenta con una <br>
                          infraestructura nueva de 18 aulas, 2 laboratorios de Física Química y Ciencias Biológicas.<br><br>

                        Para la práctica deportiva se tiene un Coliseo construido por el “Programa Evo Cumple”, inaugurando <br>
                        por el propio Presidente Evo Morales Ayma gracias al desempeño excelente de las y los estudiantes en <br>
                        los primeros juegos estudiantiles en la BARRAS ESTUDIANTILES, siendo esta experiencia que ha marcado <br>
                        la historia en los juegos estudiantiles desarrollados en el departamento y país que han sido replicados <br>
                        en las distintas gestiones.<br><br>

                        Actualmente cuenta con estudiantes entre señoritas y jóvenes provenientes de distintas zonas <br>
                        geográficas de la Provincia del Cercado y de Provincias cercanas como Sacaba, Quillacollo, Santivañez, <br>
                         cuya característica es de integrar el proceso formativo con el desempeño laboral que realizan en <br>
                         turno mañana. Esta característica de población engloba aproximadamente a  un 40 % de la población,<br>
                          siendo el restante estudiantes que comparten el tiempo de estudio con la cooperación de actividades <br>
                          con la familia. Son estudiantes con habilidades innatas al deporte, danza, teatro y a integrar equipos <br>
                          científicos en los cuales el desempeño ha sido el de los mejores en razón a haber ocupado lugares de<br>
                           relevancia como las Olimpiadas Steam, Olimpiadas científicas, Juegos estudiantiles, etc.<br><br>

                        Se puede establecer que mediante un sondeo de los últimos ocho años egresaron cerca de 960 Bachilleres,<br>
                         de los cuales un 70%  estudian en la Universidad Mayor de San Simón de Cochabamba otros prósperos <br>
                         trabajadores en diferentes actividades. Algunos concluyeron sus estudios profesionales, como Abogados,<br>
                          Médicos, Arquitectos, Ingenieros, Trabajo Social, Ciencias de la Educación, Normalista, Militares, <br>
                          Policías, etc.<br><br>

                        Actualmente  la Unidad Educativa cuenta con 30 Profesores y Profesoras que tienen formación académica <br>
                        de acuerdo a su pertinencia con el grado de Licenciatura que desempeñan sus funciones respondiendo a<br>
                         expectativas de la población educativa concordante con el sistema educativa vigente. A su vez la planta <br>
                         administrativa cuenta con 4 personas que desempeñan funciones en la institución.<br>
                        En el ámbito directivo se tiene como primer director al Prof. Eduardo Arce Torrico de los años 1969 <br>
                        al año 1975 el cual contaba con un plantel docente completo,  el año 1978 a solicitud posteriormente los <br>
                        directores que trabajaron en la institución fueron: Prof. Luis Herbas, Profa. Lidia Medrano Pozo, Profa.<br>
                         Olga Hurtado Flores, Profa. Rosemary Carrión Soto, Profa. Tania García Terrazas, Prof. Freddy Rosa <br>
                         Echeverría, Mgr. María Elvira Saavedra Troncoso, Lic. Genaro Alcon.
</p>
                        </aside>
                        
              </section>
    </section> 
             
  <section class="b_derecha">
    
        <div class="barra_acceso">
            <h2 class="titulo_acceso_online">Acceso Online</h2>
            <div class="tj">
            <a class="ingreso" href="FormSession.php">Ingresa</a></div>
        </div>
        
            <h2 class="cale">Calendario</h2>
        <div class="tj">
            <img class="cal_img" src="FOTOS/calendario.jpg">
        </div>
        <div >
            <h2 class="barra_redes">Dejanos tu comentario :D</h2>
            <div >
            <section id="dos">
  <div class="caja_comentario"> 
   <div class="texto_comentario"> 

   <form  method="post">
    <div class="seh"><p for="" class="comen">Comenta una reseña....</p><img src="FOTOS/burbuja.png" id="burbuja" width="50px" height="50px"></div>
    <div class="seh"><textarea name="comen" id="" cols="40" rows="2"> </textarea>   
    <button type="submit" value="" class="bet"><img src="FOTOS/flecha.png"></button></div>
    </form>
    
   </div>
        </div> 

<h2>Publicaciones</h2>

<div class="scro">
<?php
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
