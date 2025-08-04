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

th, td {
  width: 80px;
  height: 50px;
  text-align: center;
  font-size: 12px;
  color: white;
  background-color: #1F232E;
}
td{
   width: 400px; 
}
th {
  background-color: #1F232E; /* color de fondo para cabecera */
  font-weight: bold;
}

td:hover {
  background-color: #56627c; /* efecto al pasar el mouse */
  color: white;
}

.tabla_estu{
    border-collapse: collapse;
}
.th_estu{
background-color: #1F232E;
width: 180px;
border: 2px solid white;

}
.td_estu{
    background-color: white;
    border: 2px solid ;
}

    </style>
</head>

       <section class="b_izquierda">
  <nav class="barra_izq">
        <img src="FOTOS/logo_casa.png" class="casa">
        <h2 class="nom">Menú</h2>
        <div class="men" >
            <div class="sub">
                <div class="no"><a href="horarios.php"><h3 class="di">Horario de Clases</h3></a></div>
            <div class="no"><a href="calendario.php"><h3 class="di">Calendario</h3></a></div>  
            <div class="no"><a href="profes.php"><h3 class="di">Profesores</h3></a> </div>
            <div class="no"><a href="guias.php"><h3 class="di">Guias de Curso</h3> </a></div>
            <div class="no"><a href="himno.php"><h3 class="di">Himno al Colegio</h3></a></div>

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
