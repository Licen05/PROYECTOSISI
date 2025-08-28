<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    table {
      width: 70%;
      border-collapse: collapse;
    }
    th, td {
      border: 2px solid white;
      vertical-align: center;
    }
    tr {
      background-color: gray;
      text-align: center;
    }

.no,.nam,.sub, .noti{
    display: flex; 
    flex-wrap: wrap;
    width: 200px%;
}
.di{
    background-color: #35403E;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin: 10px 0px;
    width: 250px;
    height: 50px;
}

/*tabla visitas*/

a{
  color:white;
}

    </style>
</head>

       <section class="b_izquierda">
  <nav class="barra_izq">
    
            <a href="inicio.php"><img src="FOTOS/logo_casa.png" class="casa"></a> 
        
        <h2 class="nom">Menú</h2>
        <div class="men" >
            <div class="sub">
                <div class="no"><a href="horarios.php"><h3 class="di">Horario de Clases</h3></a></div>
            <div class="no"><a href="calendario.php"><h3 class="di">Calendario</h3></a></div>
  
            
            <?php if (isset($_SESSION["ci"])) {?>
                <div class="no"><h3 class="di">
              <a href="profes.php">Profesores</a></h3>
              </div>
              <?php }?>

              <?php if (isset($_SESSION["ci"])) {?>
                <div class="no"><h3 class="di">
              <a href="guias.php">Guias de Curso</a></h3>
              </div>
              <?php }?>
            
            <div class="no"><a href="himno.php"><h3 class="di">Himno al Colegio</h3></a></div>

            </div>
            
        </div>
        <h2 class="nam">Noticias</h2>
        <aside class="noti">
            <a href="calendario.php"><h3 class="di">Inicio de año Escolar</h3></a>
            <a href="requisitos.php"><h3 class="di">Requisitos para <br> Matricularse</h3></a>

            <div class="no"><h3 class="di">
              
            <?php if (isset($_SESSION["ci"])) {?>
                <div class="no"><h3 class="di">
              <a href="profes.php">Matriculas</a></h3>
              </div>
              <?php }?>
              
            <a href="requisitos.php"><h3 class="di">Inscripciones</h3></a>
        </aside>
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
</body>
</html>
