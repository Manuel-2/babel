<?php
header('Content-Type: application/json');

// ------- code -------------------------------------------------------------
require('./core/Router.php');
require('./core/Endpoint.php');
require('./core/Response.php');


// ------- config -------------------------------------------------------------
$config = json_decode(file_get_contents('../config.json'), false);
if ($config == false) {
  die("Server Error 500: config file broken :( call manu");
}
$GLOBALS['config'] = $config;

// ------- Actual execution -------------------------------------------------------------
$router = new Router();
$router->endpoint(new Endpoint('/users', 'GET', $router, 'xd'));


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
