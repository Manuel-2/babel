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
    <h2 id="questionCount">Resultados: 0/3</h2>
    <h3 id="questionDisplay">Dia N: Grettings, Actividad: Saludos y presentaciones</h3>
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
    <button type="button" class="" id="next">
        <h4>Siguiente</h4>
        <img src="assets/imgs/Arrow.svg" alt="prev">
    </button>

    <div id="feedbackContainer" style="display: none;">
      <h4 id='fc1' class="feedback">What is the correct response to 'How are you?</h4>
      <h4 id='fc2' class="feedback">What is the correct response to 'How are you?</h4>
      <h4 id='fc3' class="feedback">What is the correct response to 'How are you?</h4>
      <input type="button" value="Reiniciar" class="main-button h3 button bg-purple-strong" id="finalButton"/>
    </div>
    <!-- Relativos -->
    <div class="progress-bar bg-purple-ligth"></div>
    <div class="progress-bar progress-bar--fill bg-purple-strong" id="progressFill"></div>

    <!-- <div class="control-left"> -->
    <!--   <button type="button" class="button"> -->
    <!--     <img src="assets/imgs/Arrow.svg" alt="prev"> -->
    <!--   </button> -->
    <!-- </div> -->

    <!-- <div class="control-rigth"> -->
      <!-- <button type="button" class="button" id="next"> -->
      <!--   <img src="assets/imgs/Arrow.svg" alt="prev"> -->
      <!-- </button> -->
    <!-- </div> -->
  </main>

  <script>
    let game = {
      currentIndex: -1,
      questions: [],
      userAwnsers: []
    };
    let feedbackVisible = false;
    finalButton.onclick = ()=>{window.location.href = "exercies.php"};

    let abc = 'ABC';

    let optionsButtons = [
      option_A,
      option_B,
      option_C
    ];

    function renderNextQuestion() {
      removeFeedbackClases();
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
      let letter = event.currentTarget.id.split('_')[1];
      let optionIndex = abc.indexOf(letter);
      game.userAwnsers.push(optionIndex);

      feedbackVisible = true;
      showFeedback(optionIndex)
      feedbackVisible = false;
      if (game.userAwnsers.length == 3) {
        sendExercices();
      }
    }

    async function sendExercices() {
      const form = new FormData();
      form.append("awnsers", JSON.stringify(game.userAwnsers));
      let req = {
        method: "POST",
        credentials: "include",
        body: form,
      };

      const res = await fetch("api/exercise/Complete", req);
      const data = await res.json();

      if(res.status == 200){
        showResults(data.aserts);
      }else{
        showModal("Exploto el server","No se consiguio una respuesta del servidor >:(",true);
      }
    }

    function showResults(aserts){
      let questions = feedbackContainer.querySelectorAll("h4");

      aserts.forEach((result,i) =>{
        if(result){
          questions[i].classList.add("feedback-correct")
        }
        questions[i].innerText = game.questions[i].question;
      });
      let correctAwsers = aserts.reduce((total,isCorrect)=>total+=isCorrect?1:0,0)

      if(correctAwsers == 3){
        finalButton.value = "Regresar";
        finalButton.onclick = ()=>{window.location.href = "dashboard.php"};
      }

      next.style.display= "none";

      questionCount.innerText = "Resultados: " + correctAwsers + "/3";
      questionDisplay.innerText = "Tema: " + game.module + " > " + game.subModule;
      optionsContainer.style.display = "none";
      feedbackContainer.style.display = 'block';
    }


    function showFeedback(selectedOption) {
      let currentQuestion = game.questions[game.currentIndex];

      for (let i = 0; i < 3; i++) {
        optionsButtons[i].classList.add("wrong");
        optionsButtons[i].classList.add("not-selected")

        if (currentQuestion.awnser == parseInt(i)) {
          optionsButtons[i].classList.remove("wrong");
          optionsButtons[i].classList.add("correct");
        }

        if (selectedOption == i) {
          optionsButtons[i].classList.remove("not-selected");
          optionsButtons[i].classList.add("selected");
        }
      }

    }

    function removeFeedbackClases() {
      option_A.classList.remove('selected');
      option_A.classList.remove("not-selected");
      option_B.classList.remove('selected');
      option_B.classList.remove("not-selected");
      option_C.classList.remove('selected');
      option_C.classList.remove("not-selected");

      option_A.classList.remove('wrong');
      option_A.classList.remove("correct");
      option_B.classList.remove('wrong');
      option_B.classList.remove("correct");
      option_C.classList.remove('wrong');
      option_C.classList.remove("correct");
    }

    (async function() {
      let res = await fetch('/api/exercise', {
        credentials: 'include',
      });
      let data = await res.json();
      game.questions = data.exercise.exercises;
      game.module = data.module;
      game.subModule = data.subModule;
      renderNextQuestion()

      next.addEventListener("click", renderNextQuestion);
      option_A.addEventListener("click", selectOption);
      option_B.addEventListener("click", selectOption);
      option_C.addEventListener("click", selectOption);
    })();
  </script>
</body>

</html>
