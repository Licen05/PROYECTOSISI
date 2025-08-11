<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Profesor</title>
  <link href="CSS/bienvenidoProfs.css" rel="stylesheet" type="text/css" />

 
</head>

<body>

  <header>
        <div class="encabezado"> 
                    <img src="FOTOS/logo.png" class ="logo_cole"/>
                    <a  class="titulo">Unidad Educativa René Barrientos</a>
                </div>
            <div class="menu">
                    <button onclick="toggleMenu()" class="menu-boton"><img class="ft" src="FOTOS/barras.png"></button>
                    <div id="menu_desple" class="barra">
                    <ul class="botones">
                    <li><a href="inicioPR.php" id="primero" class="inicio"><i></i>INICIO</a></li>
                    <li><a href="" class="bot"><i ></i>CONOCE EL COLEGIO</a></li>
                    <li><a href="" class="bot"><i ></i>SERVICIOS</a></li>
                    <li><a href="" class="bot"><i></i>SERVICIOS EN LÍNEA</a></li>
                    <li><a href="" class="bot"><i ></i>MISIÓN Y VISIÓN</a></li>
                    <li><a href="" class="bot"><i ></i>COMUNÍCANOS</a></li>
                    <li><a href="" class="bot"><i ></i>CONTÁCTANOS</a></li>
                    </ul>
                    </div>
                        <div class="buscador" >Buscar...</div>
                        <div class="vacio"></div>
                    </div>
            <script>
              function toggleMenu() {
  const dropdown = document.getElementById("menu_desple");
  dropdown.classList.toggle("activo");
}
            
</script>
  </header> 
  <div class="cuerpo">
  <section class="b_izquierda">
  <nav class="barra_izq"> 
        <a href="inicioPR.php"><img src="FOTOS/logo_casa.png" class="casa"></a>

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
    <div class="bienvenida"> 
        <div class="texto">
            ¡Bienvenido, profesor! 
        <div class="texto2" >En este espacio, <br> usted encontrará sus datos: </div>
        </div>
                <img src="FOTOS/caracter.jpg" class="foto_estu">
        </div>
        <h1 class="titulo_datos"  > DATOS PERSONALES </h1>
         <?php
          session_start();
        ?>
            <table class="tabla_estu">
                <tr>
                    <th class="th_estu"> Nombres:</th>
                
                    <td class="td_estu"> <?= $_SESSION['nombre']?>  </td>
                </tr>
                 <tr>
                    <th class="th_estu">Apellidos:</th>
                    <td class="td_estu">  <?= $_SESSION['apellidos']?>  </td>
                </tr>
                 <tr>
                    <th class="th_estu">Curso:</th>
                    <td class="td_estu"> <?= $_SESSION['curso']?>  </td>
                </tr>
                 <tr>
                    <th class="th_estu">Fecha de Nacimiento:</th>
                    <td class="td_estu">  <?= $_SESSION['fechaNacimiento']?> </td>
                </tr>
                 <tr>
                    <th class="th_estu">Dirección:</th>
                    <td class="td_estu">  <?= $_SESSION['direccion']?> </td>
                </tr>
                 <tr>
                    <th class="th_estu">Célula de indentidad:</th>
                    <td class="td_estu"> <?= $_SESSION['ci']?> </td>
                </tr>
                 <tr>
                    <th class="th_estu">RUDE:</th>
                    <td class="td_estu"> <?= $_SESSION['rude']?> </td>
                </tr>
                <tr>
                    <th class="th_estu">Telefono:</th>
                    <td class="td_estu">  <?= $_SESSION['telefono']?></td>
                </tr>

            </table>
            <div class="botones_f">
                
               <?= 
                "<a href='cerrar.php'><button class= 'boto'>cerrar sesion</button></a>";
                 $ci=$_SESSION['ci'];
                 echo "<a href='FormEdit.php?ci=$ci'><button class= 'boto'>Editar</button> </a> "; 
                ?>
                </div>
                
  </section>
  <section class="b_derecha"> </section>
  </div>
  <?php
    include("footer.php");
    ?>
</body>

</html>