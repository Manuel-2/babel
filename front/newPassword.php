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
  <title> Babel | Nueva contraseña</title>

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
  <?php require_once("./assets/components/modal.php"); ?>

  <main>
    <h1>Recuperar contraseña</h1>
    <!-- todo: colocar la url/endpoint  -->
    <form action="/api/newPassword" method="post" id="form">
      <input type="hidden" name="email" value=<?php echo $_GET['email']; ?> />
      <input type="hidden" name="token" value=<?php echo $_GET['token']; ?> />

      <label for="password-input" class="h4">Contraseña:</label>
      <input type="password" id="password-input" name="password" value="" placeholder="*********" class="h3" required>
      <label for="confirm-input" class="h4">Confirmar contraseña:</label>
      <input type="password" id="confirm-input" name="confirm" value="" placeholder="*********" class="h3" required>
      <input type="submit" value="Confirmar" class="main-button bg-blue h3">
    </form>
    <a href="./login.php" class="h4">¿Ya tienes cuenta? Inicia session</a>
    <a href="register.php" class="h4">¿No tienes cuenta? Registrate</a>
  </main>

  <script>
    form.addEventListener('submit', async (event) => {
      event.preventDefault();
      let method = event.target.method;
      let endpoint = event.target.action;
      console.log(endpoint);
      let formData = new FormData(form);

      let req = {
        method,
        credentials: 'include',
        body: formData,
      };
      let res = await fetch(endpoint, req);
      let data = await res.json();

      if (res.status == 200) {
        // showModal("Te hemos enviado un correo para restaurar tu contraseña");
      } else {
        //TODO: llamar a un metodo para mostrar le modal de alerta
      }
    });
  </script>


</body>

</html>
