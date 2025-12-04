<?php
require(__DIR__ . '/../models/User.php');

class UserController
{

  public function showUser()
  {
    return new Response(200, [
      'test' => 'hola controlador'
    ]);
  }

  public function create()
  {
    $mail = $_POST['email'];

    $uniqueEmail = User::isEmailUnique($mail);
    if (!$uniqueEmail) {
      return new Response(400, [
        'message' => "ERROR: Email ya registrado",
      ]);
    }

    //TODO: curar la entrada nombre y correo
    $userName = $_POST['name'];
    $user = new User($userName, $mail);
    $user->save($_POST['password']);

    return new Response(201, [
      'message' => "Usuario registrado Correctamente",
      'data' => $user,
    ]);
  }
}
