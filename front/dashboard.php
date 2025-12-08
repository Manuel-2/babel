<?php
session_start();
if (isset($_SESSION['autenticated']) == false) {
  header("Location: index.php");
  die();
}
if(isset($_SESSION['hasLearningPath']) == false){
  header("Location: setup.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Babel | Inicio </title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="assets/styles/normalize.css" rel="stylesheet">
  <link href="assets/styles/babel.css" rel="stylesheet">

  <!-- estillos especificos de esta vista  -->
  <link href="assets/styles/dashboard.css" rel="stylesheet">
</head>

<body>
  <?php require_once("./assets/components/header.php"); ?>
  <?php require_once('./assets/components/modal.php'); ?>


  <main>
    <section class="days-plan" id='daysPlanContainer'> 
    </section>

    <section class="tracker soft-shadow">
      <h3 id='trackerTitle'>Idioma: Ingles</h3>
      <p id='trackerObjective' class="paragraph">Objetivo: Ingles para un viaje</p>
      <p id='trackerProgress' class="paragraph">Temas: 3/7</p>
      <ul id='trackerDaysContainer'>
        
      </ul>
      <input type="button" value="Reanudar" class="main-button button bg-purple-strong h4 exercise-button"/>
      <!-- <a href="exercies.php" >Reanudar</a> -->
      <!-- relativos -->
      <div class=" bar bg-purple-ligth"></div>
      <div class="bar bar-fill bg-purple-strong" id='totalProgressBar'></div>
    </section>
  </main>
  <footer>
    <!-- <a href=" ./setup.html" class="h4">Generar otro plan</a> -->
  </footer>
  <script>
    let dayCardTemplate = `
      <div class="card soft-shadow %expand%" id="day%n%">
        <h4 >Day %n%: %module_title%</h4>
        <div class="card-content">
          <ul>
            <li class="paragraph">%sub_1%</li>
            <li class="paragraph">%sub_2%</li>
          </ul>
          %isTheCurrentExercise%
        </div>
        <!-- relativos -->
        <div class="bar bg-purple-ligth"></div>
        <div class="bar bar-fill bg-purple-strong" style="width:calc(%progress%%);"></div>
      </div>`;

    let isTheCurrentExerciseButton = 
      `<input type="button" value="Reanudar" class="main-button button bg-purple-strong h4 exercise-button here" id="ayuda"/>`;
          
    let travelButtonTemplate =`
        <li>
          <a href="#day%n%" class="paragraph %completed%">Dia %n% %module_title%</a>
        </li>
      `; 

    // get learing paath data
    (async function(){
      let res = await fetch('/api/learningpath',{
          credentials: 'include',
      });
      let data = await res.json();
      data = data.data;


      for(let i = 0; i < data.modules.length; i++){
        let mod = data.modules[i];
        let dayNumRex = /%n%/g
        let dayCardElement = dayCardTemplate.replace(dayNumRex,i+1);
        dayCardElement = dayCardElement.replace('%module_title%',mod.title);
        dayCardElement = dayCardElement.replace('%sub_1%',mod.subModules[0].title);
        dayCardElement = dayCardElement.replace('%sub_2%',mod.subModules[1].title);


        if(data.currentModule == i){
          dayCardElement = dayCardElement.replace('%isTheCurrentExercise%',isTheCurrentExerciseButton);
          dayCardElement = dayCardElement.replace('%expand%',"");
        }else{
          dayCardElement = dayCardElement.replace('%isTheCurrentExercise%',"");
        }
  
        let moduleProgress = mod.progress * 100;
        dayCardElement = dayCardElement.replace('%progress%',moduleProgress);
        daysPlanContainer.innerHTML += dayCardElement;


        let dayTrackerElement = travelButtonTemplate.replace(dayNumRex,i+1);
        dayTrackerElement = dayTrackerElement.replace("%module_title%",mod.title);
        dayTrackerElement = dayTrackerElement.replace("%completed%",moduleProgress==100?'completed':' ');
        trackerDaysContainer.innerHTML +=dayTrackerElement;
      }

      let cardsElements = document.getElementsByClassName('card');
      cardsElements = Array.from(cardsElements);
      cardsElements.forEach(card => card.addEventListener('click', (event)=>{
        let cardElement = event.currentTarget;
        cardElement.classList.toggle('card--expanded');
      }));

      trackerTitle.innerHTML = 'Idioma: ' + data.lenguage;
      trackerObjective.innerHTML = "Objetivo: " + data.objective;
      trackerProgress.innerHTML = "Nivel: " + data.level;

      totalProgressBar.style.width = data.totalProgress*100 +'%'; 

    })();

    // let practiceButtons = document.getElementsByClassName('here');
    // practiceButtons = Array.from(practiceButtons);
    // console.log(practiceButtons);
    // practiceButtons.forEach( element => {
    //   element.addEventListener("click", (event)=>{
    //     event.stopPropagation();
    //     console.log('here');
    //   })
    // }); 

    window.addEventListener('load', () => {
    document.addEventListener('click', async (e) => {
      if (e.target.classList.contains('exercise-button')) {
          showModal("Generando Ejercicios", "Esto puede demorar unos minutos");
          let res = await fetch('/api/exercise',{method:"Post",credentials: 'include'});
          let data = await res.json();
          if(res.status == 201){
            window.location.href = "exercies.php";
          }else{
            showModal("Exploto el server", "Esto puede demorar unos minutos",true);

          }
          console.log(data);

          // peticion post
          // server genera el ejericio y lo guarda en la session
          // redirijir a la vista del ejericio


          // peticion get obtener ejericios generados previamente

          //  - recivir todos los ejericiso y sus respuestas
          //  - usuario responde cada pregunta, dar feedback instanteo sin peticionies
          //  al final del cuestionario enviar las opciones qeu seleciono el usuario
          //  revidor responde con los resultados          
      }
    });
})

  </script>
</body>

</html>
