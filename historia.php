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

  <link href="CSS/inicio.css" rel="stylesheet" type="text/css" />
  <style>
    
.bienvenida{
    display: flex;
    flex-direction: column;
    align-items:center;
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
    font-size:50px;
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
       <?php
    include("barra_iz.php");
?>
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
