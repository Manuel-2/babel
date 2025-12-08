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
  <?php require_once('./assets/components/modal.php'); ?>

  <main class="exercice-container">
    <h1 id="questionCount"></h1>
    <h1 id="questionDisplay"></h1>
    <div id="optionsContainer" class="anwsers">
      <button type="button" class="anwser-option h3" id="option_A">
        <p></p>
        <img src="assets/imgs/wrong.svg" alt="wrong">
        <img src="assets/imgs/correct.svg" alt="correct">
      </button>
      <button type="button" class="anwser-option h3" id="option_B">
        <p><span>%letter%)<span> %text%</p>
        <img src="assets/imgs/wrong.svg" alt="wrong">
        <img src="assets/imgs/correct.svg" alt="correct">
      </button>
      <button type="button" class="anwser-option h3" id='option_C'>
        <p><span>%letter%)<span> %text%</p>
        <img src="assets/imgs/wrong.svg" alt="wrong">
        <img src="assets/imgs/correct.svg" alt="correct">
      </button>
    </div>
    <!-- Relativos -->
    <div class="progress-bar bg-purple-ligth"></div>
    <div class="progress-bar progress-bar--fill bg-purple-strong" id="progressFill"></div>

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

  <script>
    let game = {
      currentIndex: -1,
      questions: [],
      userAwnsers: []
    };
    let feedbackVisible = false;

    let abc = 'abc';

    function renderNextQuestion() {
      if (game.currentIndex >= 2) return;

      game.currentIndex++;
      questionCount.innerText = `Pregunta: ${game.currentIndex + 1}/3`;

      let currentCuestion = game.questions[game.currentIndex];
      questionDisplay.innerHTML = currentCuestion.question;

      option_A.querySelector("p").innerText = currentCuestion.options[0];
      option_B.querySelector("p").innerText = currentCuestion.options[1];
      option_C.querySelector("p").innerText = currentCuestion.options[2];

      progressFill.style.width = (game.currentIndex + 1) / 3 * 100 + "%";
    }

    function selectOption(event) {
      if (feedbackVisible) return;
      let optionIndex = event.target.id.split('_')[1];
      game.userAwnsers.push(optionIndex);

      feedbackVisible = true;
      //todo: show feedback
      setTimeout(() => {
        feedbackVisible = false;
        renderNextQuestion();
        if (game.userAwnsers.length == 3) {
          console.log(game);
        }
      }, 2000);
    }

    function showFeedback() {

    }

    function removeFeedbackClases() {

    }

    (async function() {
      let res = await fetch('/api/exercise', {
        credentials: 'include',
      });
      let data = await res.json();
      game.questions = data.exercise.exercises;
      console.log(game);
      renderNextQuestion()

      option_A.addEventListener("click", selectOption);
      option_B.addEventListener("click", selectOption);
      option_C.addEventListener("click", selectOption);
    })();
  </script>
</body>

</html>
