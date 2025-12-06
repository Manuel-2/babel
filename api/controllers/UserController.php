<?php
require(__DIR__ . '/../models/User.php');

class UserController
{

  public function show()
  {
    return new Response(200, [
      'test' => 'hola controlador'
    ]);
  }

  public function create()
  {
    //TODO: curar la entrada nombre y correo
    $mail = $_POST['email'];

    if (strlen($mail) > 40) {
      return new Response(400, [
        'message' => "ERROR: Correo maximo 40 caracteres >:(",
      ]);
    }
    $uniqueEmail = User::isEmailUnique($mail);
    if (!$uniqueEmail) {
      return new Response(400, [
        'message' => "ERROR: Email ya registrado",
      ]);
    }

    $userName = $_POST['name'];
    if (strlen($userName) > 30) {
      return new Response(400, [
        'message' => "ERROR: Nombre de usuario de maximo 30 caracteres >:(",
      ]);
    }

    $user = new User($userName, $mail);
    $user->save($_POST['password']);

    session_start();
    $_SESSION['autenticated'] = true;
    $_SESSION['userId'] = $user->id;

    return new Response(201, [
      'message' => "Usuario registrado Correctamente",
      'data' => $user,
    ]);
  }
}
