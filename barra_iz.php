<!DOCTYPE html> <!-- Indica que el documento es HTML5 -->
<html lang="en"> <!-- El idioma del contenido es inglés -->
<head>
    <meta charset="UTF-8"> <!-- Codificación UTF-8 para admitir caracteres especiales -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Para diseño responsive -->
    <title>Document</title> <!-- Título que aparece en la pestaña -->
    <style>
    
/* --- ESTILOS DE TABLA --- */
.b_izquierda{
  grid-area: iz;
}
table {
      width: 70%;                /* Ancho de la tabla */
      border-collapse: collapse; /* Une los bordes de celdas */
    }
th, td {
      border: 2px solid white;   /* Bordes blancos */
      vertical-align: center;
      width: 30px;    /* Centra verticalmente */
    }
tr {  /* Fondo gris para las filas */
      text-align: center;        /* Texto centrado */
    }

/* --- ESTILOS DE MENÚ --- */
.no,.nam,.sub, .noti{
    display: flex;        /* Flexbox */
    flex-wrap: wrap;      /* Permite que los elementos bajen a otra línea */
}
.di{
    background-color: #35403E;  /* Fondo gris oscuro */
    color: white;               /* Texto blanco */
    display: flex;              /* Flexbox */
    justify-content: center;    /* Centrar horizontal */
    align-items: center;        /* Centrar vertical */
    text-align: center;         /* Texto centrado */
    margin: 10px 0px;           /* Márgenes arriba y abajo */
    width: 250px;               /* Ancho fijo */
    height: 80px;               /* Alto fijo */
}

/* --- ENLACES --- */
a{
  color: white; /* Todos los enlaces serán blancos */
}

/* Imagen casita (icono inicio) */
.casa{
  width: 60px;
  height: 60px;
}

    </style>
</head>
<br> <!-- Salto de línea (no recomendable usar fuera de <body>) -->

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
      <a href="calendario.php"><h3 class="di">Inicio de año Escolar</h3></a>
      <a href="requisitos.php"><h3 class="di">Requisitos para <br> Matricularse</h3></a>

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
