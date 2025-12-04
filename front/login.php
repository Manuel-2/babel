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
  <header class="header">
    <div class="header-left soft-shadow">
      <div>
        <a class="header-logo" href="dashboard.html">
          <img src="assets/imgs/Logo.svg" alt="">
          <h3 class="h3">babel</h3>
        </a>
      </div>
      <div>
        <ul>
          <li><a class="h4" href="./dashboard.html">Inicio</a></li>
          <li><a class="h4" href="#">Acerca</a></li>
        </ul>
      </div>

      <div class="burger-container">
        <label for="burger-check" class="burger"></label>
        <input type="checkbox" id="burger-check">
        <nav class="burger-nav soft-shadow h4">
          <ul>
            <li><a href="dashboard.html">Inicio</a></li>
            <li><a href="#">Acerca</a></li>
            <li><a href="#">Cerrar Sesíon</a></li>
            <li><a href="setup.html">Ajustes</a></li>
          </ul>
        </nav>
      </div>
    </div>
    <div class="header-rigth">
      <button type="button" class="soft-shadow"><img src="assets/imgs/Logout Icon.svg" alt=""></button>
      <a href="#" class="soft-shadow h4 button">Ajustes</a>
    </div>
  </header>

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
    form.addEventListener('submit', (event) => {
      event.preventDefault();
      let method = event.target.method;
      let endpoint = event.target.action;
      let formData = new FormData(form);

      (async function() {
        let req = {
          method,
          credentials: 'include',
          body: formData,
        };
        let res = await fetch(endpoint, req);
        let data = await res.json();

        console.log(data);
        if (res.status >= 200 <= 300) {
          //TODO: llamar a un metodo para mostrar le modal de alerta, le aparece un boton log in y lo redirije al clidk
        } else {
          //TODO: llamar a un metodo para mostrar le modal de alerta
        }
      })();
    });
  </script>


</body>

</html>
