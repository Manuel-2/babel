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
    <section class="days-plan">

      <div class="card soft-shadow card--expanded">
        <h4 id="day1">Day 1: Pronoumns</h4>
        <div class="card-content">
          <ul>
            <li class="paragraph">First Person 3/3</li>
            <li class="paragraph">Second Person 2/3</li>
            <li class="paragraph">Third Person 0/3</li>
          </ul>
          <a class="main-button bg-purple-strong h4" href="exercies.html">Practicar</a>
        </div>
        <!-- relativos -->
        <div class="bar bg-purple-ligth"></div>
        <div class="bar bar-fill bg-purple-strong"></div>
      </div>


      <div class="card soft-shadow  ">
        <h4 id="day2">Day 2: Pronoumns</h4>
        <div class="card-content">
          <ul>
            <li class="paragraph">First Person 3/3</li>
            <li class="paragraph">Second Person 2/3</li>
            <li class="paragraph">Third Person 0/3</li>
          </ul>
          <a class="main-button bg-purple-strong h4" href="exercies.html">Practicar</a>
        </div>
        <!-- relativos -->
        <div class="bar bg-purple-ligth"></div>
        <div class="bar bar-fill bg-purple-strong"></div>
      </div>


      <div class="card soft-shadow  ">
        <h4 id="day3">Day 3: Pronoumns</h4>
        <div class="card-content">
          <ul>
            <li class="paragraph">First Person 3/3</li>
            <li class="paragraph">Second Person 2/3</li>
            <li class="paragraph">Third Person 0/3</li>
          </ul>
          <a class="main-button bg-purple-strong h4" href="exercies.html">Practicar</a>
        </div>
        <!-- relativos -->
        <div class="bar bg-purple-ligth"></div>
        <div class="bar bar-fill bg-purple-strong"></div>
      </div>


      <div class="card soft-shadow  ">
        <h4 id="day4">Day 4: Pronoumns</h4>
        <div class="card-content">
          <ul>
            <li class="paragraph">First Person 3/3</li>
            <li class="paragraph">Second Person 2/3</li>
            <li class="paragraph">Third Person 0/3</li>
          </ul>
          <a class="main-button bg-purple-strong h4" href="exercies.html">Practicar</a>
        </div>
        <!-- relativos -->
        <div class="bar bg-purple-ligth"></div>
        <div class="bar bar-fill bg-purple-strong"></div>
      </div>


      <div class="card soft-shadow  ">
        <h4 id="day5">Day 5: Pronoumns</h4>
        <div class="card-content">
          <ul>
            <li class="paragraph">First Person 3/3</li>
            <li class="paragraph">Second Person 2/3</li>
            <li class="paragraph">Third Person 0/3</li>
          </ul>
          <a class="main-button bg-purple-strong h4" href="exercies.html">Practicar</a>
        </div>
        <!-- relativos -->
        <div class="bar bg-purple-ligth"></div>
        <div class="bar bar-fill bg-purple-strong"></div>
      </div>


      <div class="card soft-shadow  ">
        <h4 id="day6">Day 6: Pronoumns</h4>
        <div class="card-content">
          <ul>
            <li class="paragraph">First Person 3/3</li>
            <li class="paragraph">Second Person 2/3</li>
            <li class="paragraph">Third Person 0/3</li>
          </ul>
          <a class="main-button bg-purple-strong h4" href="exercies.html">Practicar</a>
        </div>
        <!-- relativos -->
        <div class="bar bg-purple-ligth"></div>
        <div class="bar bar-fill bg-purple-strong"></div>
      </div>


      <div class="card soft-shadow  ">
        <h4 id="day7">Day 7: Pronoumns</h4>
        <div class="card-content">
          <ul>
            <li class="paragraph">First Person 3/3</li>
            <li class="paragraph">Second Person 2/3</li>
            <li class="paragraph">Third Person 0/3</li>
          </ul>
          <a class="main-button bg-purple-strong h4" href="exercies.html">Practicar</a>
        </div>
        <!-- relativos -->
        <div class="bar bg-purple-ligth"></div>
        <div class="bar bar-fill bg-purple-strong"></div>
      </div>




    </section>

    <section class="tracker soft-shadow">
      <h3>Idioma: Ingles</h3>
      <p class="paragraph">Objetivo: Ingles para un viaje</p>
      <p class="paragraph">Temas: 3/7</p>
      <ul>
        <li>
          <a href="#day1" class="paragraph completed">day 1 Pronoumns</a>
        </li>
        <li>
          <a href="#day2" class="paragraph completed">day 2 Pronoumns</a>
        </li>
        <li>
          <a href="#day3" class="paragraph completed">day 3 Pronoumns</a>
        </li>
        <li>
          <a href="#day4" class="paragraph">day 4 Pronoumns</a>
        </li>
        <li>
          <a href="#day5" class="paragraph">day 5 Pronoumns</a>
        </li>
        <li>
          <a href="#day6" class="paragraph">day 6 Pronoumns</a>
        </li>
        <li>
          <a href="#day7" class="paragraph">day 7 Pronoumns</a>
        </li>
      </ul>
      <a href="exercies.html" class="main-button bg-purple-strong h4">Reanudar</a>
      <!-- relativos -->
      <div class=" bar bg-purple-ligth"></div>
      <div class="bar bar-fill bg-purple-strong"></div>

    </section>
  </main>
  <footer>
    <!-- <a href=" ./setup.html" class="h4">Generar otro plan</a> -->
  </footer>
</body>

</html>
