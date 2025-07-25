<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <title>Alumno</title>
  <link href="CSS/inicio.css" rel="stylesheet" type="text/css" />

 
</head>

<body>

  <header> 
        <div class="encabezado"> 
                    <img src="FOTOS/logo.png" class ="logo_cole"/>
                    <a href="inicio.php" class="titulo">Unidad Educativa Federico Aguiló</a>
                </div>
            <div class="menu">
                    <button onclick="toggleMenu()" class="menu-boton"><img class="ft" src="FOTOS/barras.png"></button>
                    <div id="menu_desple" class="barra">
                    <ul class="botones">
                    <li><a href="" id="primero" class="inicio"><i></i>INICIO</a></li>
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
                        <h1 class="bienvenidos_texto">BIENVENIDOS..</h1>
                        <img src="FOTOS/SA.png" class="parrafo">
                        <aside class="parrafo">
                        <p>Nos sentimos orgullosos por llevar adelante el quehacer pedagógico a partir del enfoque de <br>
                            la EDUCACIÓN PERSONALIZADA , que permite brindar una experiencia educativa de crecimiento <br>
                            intelectual y espiritual con la participación activa de los estudiantes que forman parte de <br>
                            la familia Aguilista.</p>
                        </aside>
              </section>
    </section>
             
  <section class="b_derecha">
        <div class="barra_acceso">
            <h2 class="titulo_acceso_online">Acceso Online</h2>
            <a class="ingreso" href="FormSession.php">Ingresa</a>
        </div>
        <div >
            <h2 class="cale">Calendario</h2>
            <img class="cal_img" src="FOTOS/calendario.jpg">
        </div>
        <div >
            <h2 class="barra_redes">Visitanos</h2>
        </div>  
  </section>
  </div>
    <footer>©Copyright U.E. Federico Aguiló</footer>
</body>

</html>