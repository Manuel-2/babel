<!DOCTYPE html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Babel | Ajustes</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="assets/styles/normalize.css" rel="stylesheet">
  <link href="assets/styles/babel.css" rel="stylesheet">

  <!-- estillos especificos de esta vista  -->
  <link href="assets/styles/settings.css" rel="stylesheet">
</head>

<body>
  <?php require_once('assets/components/header.php') ?>


  <main>
    <article>
      <h1>Ajustes</h1>
      <form>
        <h2>Preferencias</h2>
        <label for="reduce-motions-input" class="h4">Animaciones:</label>
        <input id="reduce-motions-input" type="checkbox" name="" value="" checked class="h4">
      </form>
      <hr>
      <br>
      <a id='setup' href="./setup.php" class="main-button paragraph button">Crear nuevo plan</a>
      </h3>
      <a id='return' href="./index.php" class="main-button h3 bg-green button">Regresar</a>
    </article>
  </main>
</body>
