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

  public function newPassword()
  {
    $email = $_POST['email'];
    $token = $_POST['token'];
    $password = $_POST['password'];

    $user = User::findUserByEmail($email);

    if ($token != $user['recovery_token']) {
      return new Response(401, [
        'Message' => "Token incorrecto"
      ]);
    }

    $recoveryToken = bin2hex(random_bytes(20));
    $hash = password_hash($password, PASSWORD_BCRYPT);

    DbConnector::statementWithParams("update users set password = ?, recovery_token = ? where email = ?", [$hash, $recoveryToken, $email]);

    return new Response(200, [
      'message' => 'Contraseña actualizada'
    ]);
  }

  public function forgotPassword()
  {
    $email = $_POST['email'];

    $user = DbConnector::statementWithParams('select email,recovery_token from users where email = ?', [$email]);
    $exists = count($user) > 0;
    if ($exists == false) {
      return new Response(404, ['message' => "Correo no registrado"]);
    }
    $user = $user[0];

    $token = $user['recovery_token'];

    $emailHtml = file_get_contents(__DIR__ . '/../../forgotPassword.html');
    $emailHtml = str_replace('%link%', "babel.com/newPassword.php?token=$token&email=$email", $emailHtml);


    $subject = "Babel | Recuperar contraseña";
    $message = $emailHtml;
    $headers = "From: mape_23@alu.uabcs.mx";
    $headers  .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "From: Mi App <no-reply@miapp.com>\r\n";

    if (mail($email, $subject, $message, $headers)) {
      return new Response(200, []);
    } else {
      return new Response(500, ["message" => "no se pudo enviar el correo"]);
    }
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
