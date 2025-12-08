<?php
session_start();
if (isset($_SESSION['autenticated'])) {
  header("Location: dashboard.php");
  die();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Babel | Iniciar sesion</title>

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
    <h1>Iniciar Sesión</h1>
    <!-- todo: colocar la url/endpoint  -->
    <form action="/api/sessions" method="post" id="form">
      <label for="email-input" class="h3">Correo Electronico:</label>
      <input type="email" id="email-input" name="email" value="" placeholder="correo@email.com" class="h3">
      <label for="password-input" class="h3">Contraseña:</label>
      <input type="password" id="password-input" name="password" value="" placeholder="*********" class="h3">
      <input type="submit" value="Registar" class="main-button bg-blue h3">
    </form>
    <a href="register.php" class="h4">¿No tienes cuenta? Registrate</a>
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

        if (res.status == 201) {
            window.location.href = './dashboard.php';
        } else {
          //TODO: llamar a un metodo para mostrar le modal de alerta
        }
    });
  </script>


</body>

</html>
