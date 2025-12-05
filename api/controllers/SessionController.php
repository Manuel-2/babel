<?php

class SessionController
{

  public function login()
  {
    $password = $_POST['password'];
    $email = $_POST['email'];

    $exists = !User::isEmailUnique($email);

    if ($exists == false) {
      return new Response(400, ['message' => "Credenciales(Correo o contraseña) incorrectas"]);
    }

    $user = User::findUserByEmail($email);

    $correct = password_verify($password, $user['password']);
    if ($correct) {
      session_start();
      $_SESSION['autenticated'] = true;
      $_SESSION['userId'] = $user['id'];
      return new Response(201, ['data' => $user]);
    } else {
      return new Response(400, ['message' => 'Credenciales(Correo o contraseña) incorrectas']);
    }
  }

  public function logout()
  {
    session_destroy();
    return new Response(200, ['message' => 'Session cerrada']);
  }
}
