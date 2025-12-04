<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Babel</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="./assets/styles/normalize.css" rel="stylesheet">
  <link href="./assets/styles/babel.css" rel="stylesheet">

  <!-- estillos especificos de esta vista  -->
  <link href="./assets/styles/index.css" rel="stylesheet">
</head>

<body>
  <?php require_once("./assets/components/header.html"); ?>
  <main>
    <article>
      <section class="hero">
        <img class="hero-image" src="./assets/imgs/Tower.svg"></img>
        <div class="hero-card">
          <h1><span>Practica idiomas con ejercicios usando babel!</span></h1>
          <p class="h3"> <span>Aprende un nuevo idioma de manera fácil y organizada. Nuestra inteligencia artificial
              crea para
              ti un plan
              semanal personalizado con ejercicios prácticos, preguntas interactiva a corde a tus nececidades</span></p>
          <div class="buttons">
            <a href="login.php" class="secondary-button button h3 bg-clear">Incia Sesion</a>
            <a href="register.php" class="secondary-button button h3 bg-clear">Registrate</a>
          </div>
        </div>
      </section>
    </article>
    <article class="features">
      <div class="card">
        <img src="./assets/imgs/Check.svg" alt="up arrow">
        <h3>Practica</h3>
        <p class="h4">Resuelve ejercicios de opcion multiple y obten feedback instaneamente</p>
      </div>
      <div class="card">
        <p class="ia-icon">IA</p>
        <h3>Inovador</h3>
        <p class="h4">Utiliza IA para generar ejericios acorde a tus neccesidaddes</p>
      </div>

      <div class="card">
        <img src="./assets/imgs/phone.svg" alt="up arrow">
        <h3>Portatil</h3>
        <p class="h4">Dispoinble en version web para escritorio y movil</p>
      </div>
    </article>
  </main>
</body>

</html>
