<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Babel | Ejercicios</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="assets/styles/normalize.css" rel="stylesheet">
  <link href="assets/styles/babel.css" rel="stylesheet">

  <!-- estillos especificos de esta vista  -->
  <link href="assets/styles/exercies.css" rel="stylesheet">
</head>

<body>
  <?php require_once('assets/components/header.php'); ?>

  <main class="exercice-container">
    <h1><span id="question-count">Question 2/3</span><br>What is the correct response to "How are you?"</h1>
    <div class="anwsers">
      <button type="button" class="anwser-option h3 not-selected correct">
        <p><span>A) <span>I'm fine, thank you.</p>
        <img src="assets/imgs/wrong.svg" alt="wrong">
        <img src="assets/imgs/correct.svg" alt="correct">
      </button>
      <button type="button" class="anwser-option h3 selected wrong">
        <p><span>B) <span>I'm fine, thank you.</p>
        <img src="assets/imgs/wrong.svg" alt="wrong">
        <img src="assets/imgs/correct.svg" alt="correct">
      </button>
      <button type="button" class="anwser-option h3 not-selected wrong">
        <p><span>C) <span>I'm fine, thank you.</p>
        <img src="assets/imgs/wrong.svg" alt="wrong">
        <img src="assets/imgs/correct.svg" alt="correct">

      </button>
    </div>
    <!-- Relativos -->
    <div class="progress-bar bg-purple-ligth"></div>
    <div class="progress-bar progress-bar--fill bg-purple-strong"></div>

    <div class="control-left">
      <button type="button" class="button">
        <img src="assets/imgs/Arrow.svg" alt="prev">
      </button>
    </div>

    <div class="control-rigth">
      <button type="button" class="button">
        <img src="assets/imgs/Arrow.svg" alt="prev">
      </button>
    </div>
  </main>

</body>

</html>
