<?php
session_start();
if (isset($_SESSION['autenticated']) == false) {
  header("Location: index.php");
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

  <main>
    <section class="days-plan" id='daysPlanContainer'> 
    </section>

    <section class="tracker soft-shadow">
      <h3 id='trackerTitle'>Idioma: Ingles</h3>
      <p id='trackerObjective' class="paragraph">Objetivo: Ingles para un viaje</p>
      <p id='trackerProgress' class="paragraph">Temas: 3/7</p>
      <ul id='trackerDaysContainer'>
        
      </ul>
      <a href="exercies.php" class="main-button bg-purple-strong h4">Reanudar</a>
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
      <div class="card soft-shadow" id="day%n%">
        <h4 >Day %n%: %module_title%</h4>
        <div class="card-content">
          <ul>
            <li class="paragraph">%sub_1%</li>
            <li class="paragraph">%sub_2%</li>
          </ul>
          <a class="main-button bg-purple-strong h4" href="exercies.php">Practicar</a>
        </div>
        <!-- relativos -->
        <div class="bar bg-purple-ligth"></div>
        <div class="bar bar-fill bg-purple-strong" style="width:calc(%progress%%);"></div>
      </div>`;


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

      console.log(data);

      for(let i = 0; i < data.modules.length; i++){
        let mod = data.modules[i];
        let dayNumRex = /%n%/g
        let dayCardElement = dayCardTemplate.replace(dayNumRex,i+1);
        dayCardElement = dayCardElement.replace('%module_title%',mod.title);
        dayCardElement = dayCardElement.replace('%sub_1%',mod.subModules[0].title);
        dayCardElement = dayCardElement.replace('%sub_2%',mod.subModules[1].title);
  
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
  
  </script>
</body>

</html>
