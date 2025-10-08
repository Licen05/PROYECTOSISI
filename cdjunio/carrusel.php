<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Carrusel básico</title>
  <style>
    .carrusel {
      width: 600px;
      height: 350px;
      overflow: hidden;
      margin: 30px auto;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.4);
    }

    .imagenes {
      display: flex;
      width: 2400px; /* 600px × 4 imágenes */
      animation: slide 12s infinite;
    }

    .imagenes img {
      width: 600px;
      height: 350px;
    }

    @keyframes slide {
      0% { transform: translateX(0); }
      25% { transform: translateX(-600px); }
      50% { transform: translateX(-1200px); }
      75% { transform: translateX(-1800px); }
      100% { transform: translateX(0); }
    }
  </style>
</head>
<body>

  <h2 style="text-align:center;">Carrusel Automático</h2>

  <div class="carrusel">
    <div class="imagenes">
      <img src="FOTOS/conejo.png" alt="Imagen 1">
      <img src="FOTOS/3.jpg" alt="Imagen 2">
      <img src="FOTOS/4.jpg" alt="Imagen 3">
      <img src="FOTOS/6.jpg" alt="Imagen 4">
    </div>
  </div>

</body>
</html>
