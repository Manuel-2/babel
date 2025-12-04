<?php
header("Access-Control-Allow-Origin: http://localhost:80");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");

header('Content-Type: application/json');

// ------- code -------------------------------------------------------------
require('./core/Router.php');
require('./core/Endpoint.php');
require('./core/Response.php');
require('./controllers/UserController.php');

// ------- config -------------------------------------------------------------
$config = json_decode(file_get_contents('../config.json'), false);
if ($config == false) {
  die("Server Error 500: config file broken :( call manu");
}
$GLOBALS['config'] = $config;

// ------- Actual execution -------------------------------------------------------------
$router = new Router();

//TODO: forma para evitar instanciar controlladores manualmente

// ocupa autenticacion
$router->add(new Endpoint('GET', '/users', $router, 'showUser'));

// no ocupa
$router->add(new Endpoint('POST', '/users', $router, 'createUser', false));
$router->add(new Endpoint('POST', '/users', $router, 'login', false));
$router->add(new Endpoint('POST', '/users', $router, 'logout', false));


$res = $router->handleRequest();
http_response_code($res->statusCode);
echo json_encode($res->body);

// session_start();
// if (array_key_exists("user", $_SESSION)) {
//   header("location: dashboard.php");
//   die();
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//   $name = $_POST['name'];
//   $email = $_POST['email'];
//   $password = $_POST['password'];
//   $confirm = $_POST['confirm'];

//   if ($confirm != $password) {

//   }
// }
