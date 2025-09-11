<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    
.barra_sup{
    grid-area: he;
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    padding: 50px 80px;
    flex-wrap: wrap;
    background-color: rgb(255, 255, 255);
    align-items: center;
}
.logo{
    height: 140px;
    border-radius: 50%;
}
.pedro{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.titulo{
    padding-left: 50px;
    display: flex;
    font-size: 1em;
}

@media (max-width:900px){
  
.barra_sup{
font-size: 20px;
}
    }

.logo{
    height: 100px;
    border-radius: 50%;
}
.pedro{
    display: flex;
    flex-direction: row;
    align-items: center;
}
.titulo{
    padding-left: 25px;
    display: flex;
    font-size: 2em;
}    
a{
    text-decoration:none;
    color:black;
}
</style>
</head>
<body>

<header> 
<div class ="barra_sup">
    <a href="inicio.php"><div class="pedro">
        <img class ="logo" src="FOTOS/logo.jpeg"> <h2 class="titulo">U.E. RENÉ BARRIENTOS</h2>
    </div> 
</a>
</div>
</header>
</body>
</html>

