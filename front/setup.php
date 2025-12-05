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
  <title> Babel | Generar plan</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
    rel="stylesheet">
  <link href="assets/styles/normalize.css" rel="stylesheet">
  <link href="assets/styles/babel.css" rel="stylesheet">

  <!-- estillos especificos de esta vista  -->
  <link href="assets/styles/main-form.css" rel="stylesheet">
</head>

<body>
  <?php require_once("./assets/components/header.php"); ?>

  <main>
    <h1>Generar plan de estudio!</h1>
    <!-- todo: colocar la url/endpoint  -->
    <form action="/api/learingpath" method="post" id="form">
      <label for="lengauge-input" class="h3">Que Lenguaje quieres Aprender:</label>
      <select id="lengauge-input" class="h3" name="language">
        <option value="English">Ingles</option>
        <option value="Spanish">Español</option>
        <option value="Portugese">Portuges</option>
      </select>

      <label for="level-input" class="h3">Nivel de dominio:</label>
      <select id="level-input" class="h3" name="level">
        <option value="Basic">Basico</option>
        <option value="Medium">Medio</option>
        <option value="Advance">Avanzado</option>
      </select>

      <label for="objective-input" class="h3">Objetivo:</label>
      <select id="objective-input" class="h3" name="objective">
        <option value="Fun">Diversion</option>
        <option value="Travel">Viajar</option>
        <option value="School">Escuela</option>
        <option value="Work">Trabajo</option>
      </select>
      <input type="submit" value="Generar Plan" class="main-button bg-blue h3">
    </form>
  </main>

  <script>
    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      let method = event.target.method;
      let endpoint = event.target.action;
      let formData = new FormData(form);
      let req = {
        method,
        credentials: 'include',
        body: formData,
      };

      let res = await fetch(endpoint, req);
      let data = await res.json();

      // TODO: mostar el modal con animacion de carga y cuandoo se genere el plan de estudios redijir al dashboard
      console.log(data);
    });
  </script>
</body>

</html>
