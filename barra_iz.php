<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
.b_izquierda{
    grid-area: iz;
    padding: 5px;
  
  
}
.no,.nam,.sub, .noti{
    display: flex;
    flex-wrap: wrap;
    width: 100%;
}
.di{
    background-color: #1F232E;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    margin: 10px 0px;
    width: 250px;
    height: 50px;
}

/*.espacios{
    grid-area: ce;
    margin-left: 250px;
    display: flex;
    width: 100%;
    height: max-content;
 
   
        }*/
    </style>
</head>

     <section class="b_izquierda">
  <nav class="barra_izq">
        <img src="FOTOS/logo_casa.png" class="casa">
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
        <aside class="noti">
            <a href="calendario.php"><h3 class="di">Inicio de año Escolar</h3></a>
            <a href="requisitos.php"><h3 class="di">Requisitos para <br> Matricularse</h3></a>
            <a href="profes.php"><h3 class="di">Matriculas</h3></a>
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
