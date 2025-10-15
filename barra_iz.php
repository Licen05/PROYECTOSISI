<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
        <link rel="stylesheet" href="CSS/b_izquierda.css">
        <style>
          .sub,.noti{
            display:flex;
            gap:10px;
          }
        </style>
</head>
<body>
  
<!-- Sección lateral izquierda -->
<section class="b_izquierda">
  <nav class="barra_izq"> <!-- Barra de navegación izquierda -->
          
    <!-- Título del menú -->
    <h2 class="nom">Menú</h2>
    
    <!-- Contenedor del menú -->
    <div class="men">
      <div class="sub">
        
        <!-- Opción: Horario -->
        <div class="no"><a href="horarios.php">
          <h3 class="di">Horario de Clases</h3></a>
        </div>
        
        <!-- Opción: Calendario -->
        <div class="no"><a href="calendario.php">
          <h3 class="di">Calendario</h3></a></div>
  
        <!-- Opción visible solo si hay sesión activa -->
        <?php if (isset($_SESSION["ci"])) {?>
        <div class="no"><h3 class="di">
          <a href="profes.php">Profesores</a></h3>
        </div>
        <?php }?>
        
        <!-- Otra opción solo con sesión activa -->
        <?php if (isset($_SESSION["ci"])) {?>
        <div class="no"><h3 class="di">
          <a href="guias.php">Guias de Curso</a></h3>
        </div>
        <?php }?>
            
        <!-- Opción: Himno -->
        <div class="no"><a href="himno.php">
          <h3 class="di">Himno al Colegio</h3></a></div>
      </div>
    </div>
    
    <!-- Sección de noticias -->
    <h2 class="nam">Noticias</h2>
    <aside class="noti">
      
      <!-- Noticias generales -->
      <a href="iniciodeAño.php"><h3 class="di">Inicio de año Escolar</h3></a>
      <a href="requieres.php"><h3 class="di">Requisitos para <br> Matricularse</h3></a>

      <!-- Matrículas: solo si hay sesión activa -->
      <div class="no"><h3 class="di">
        <?php if (isset($_SESSION["ci"])) {?>
        <a href="profes.php">Matrículas</a></h3>
      </div>
      <?php }?>
      
      <!-- Opción: Inscripciones --> 
      <div class="no"><h3 class="di">      
        <a href="requisitos.php"><h3 class="di">Inscripciones</h3></a>
      </div>
    </aside>
      <!-- Opción: Visitas -->
    
<h2>Visitas</h2>
<aside class="tabla">
  <div class="no">
    <h3 class="di">
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
    </h3>
  </div>
</aside>
  </nav>
</section>




</body>
</html>
