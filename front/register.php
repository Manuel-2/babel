<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Babel | Registro</title>
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
  <?php require_once("./assets/components/header.html"); ?>

  <main style="margin-top: 80px;">
    <h1>Registro</h1>
    <!-- todo: colocar la url/endpoint  -->
    <form method="post" action="/api/user">
      <label for="name-input" class="h4">Nombre de Usuario:</label>
      <input type="text" id="name-input" name="name" value="" placeholder="nombre" class="h3" required>
      <label for="email-input" class="h4">Correo Electronico:</label>
      <input type="email" id="email-input" name="email" value="" placeholder="correo@email.com" class="h3" required>
      <label for="password-input" class="h4">Contraseña:</label>
      <input type="password" id="password-input" name="password" value="" placeholder="*********" class="h3" required>
      <label for="confirm-input" class="h4">Confirmar contraseña:</label>
      <input type="password" id="confirm-input" name="confirm" value="" placeholder="*********" class="h3" required>
      <input type="submit" value="Registar" class="main-button bg-blue h3">
    </form>
    <a href="./login.php" class="h4">¿Ya tienes cuenta? Inicia session</a>
  </main>

</body>

</html>
