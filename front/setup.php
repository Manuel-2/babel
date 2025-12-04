<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Babel | Generar plan</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="../public/styles/normalize.css" rel="stylesheet">
  <link href="../public/styles/babel.css" rel="stylesheet">

  <!-- estillos especificos de esta vista  -->
  <link href="../public/styles/main-form.css" rel="stylesheet">
</head>

<body>
  <header class="header">
    <div class="header-left soft-shadow">
      <div>
        <a class="header-logo" href="dashboard.html">
          <img src="../public/imgs/Logo.svg" alt="">
          <h3 class="h3">babel</h3>
        </a>
      </div>
      <div>
        <ul>
          <li><a class="h4" href="./dashboard.html">Inicio</a></li>
          <li><a class="h4" href="#">Acerca</a></li>
        </ul>
      </div>

      <div class="burger-container">
        <label for="burger-check" class="burger"></label>
        <input type="checkbox" id="burger-check">
        <nav class="burger-nav soft-shadow h4">
          <ul>
            <li><a href="dashboard.html">Inicio</a></li>
            <li><a href="#">Acerca</a></li>
            <li><a href="#">Cerrar Sesíon</a></li>
            <li><a href="setup.html">Ajustes</a></li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="header-rigth">
      <button type="button" class="soft-shadow"><img src="../public/imgs/Logout Icon.svg" alt=""></button>
      <a href="#" class="soft-shadow h4 button">Ajustes</a>
    </div>
  </header>

  <main>
    <h1>Generar plan de estudio!</h1>
    <!-- todo: colocar la url/endpoint  -->
    <form action="#">
      <label for="lengauge-input" class="h3">Que Lenguaje quieres Aprender:</label>
      <select id="lengauge-input" class="h3">
        <option value="English">Ingles</option>
        <option value="Spanish">Español</option>
        <option value="Portugese">Portuges</option>
      </select>

      <label for="level-input" class="h3">Nivel de dominio:</label>
      <select id="level-input" class="h3">
        <option value="Basic">Basico</option>
        <option value="Medium">Medio</option>
        <option value="Advance">Avanzado</option>
      </select>

      <label for="objective-input" class="h3">Objetivo:</label>
      <select id="objective-input" class="h3">
        <option value="Fun">Diversion</option>
        <option value="Travel">Viajar</option>
        <option value="School">Escuela</option>
        <option value="Work">Trabajo</option>
      </select>
      <input type="submit" value="Generar Plan" class="main-button bg-blue h3">
    </form>
  </main>

</body>

</html>
