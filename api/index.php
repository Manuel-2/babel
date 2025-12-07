<?php
header("Access-Control-Allow-Origin: http://localhost:80");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

// ------- code -------------------------------------------------------------------------
require('./core/Router.php');
require('./core/Endpoint.php');
require('./core/Response.php');
require('./core/DbConnector.php');

require('./controllers/UserController.php');
require('./controllers/SessionController.php');
require('./controllers/LearingPathController.php');

// ------- setup global (config, and fuctions)-------------------------------------------
require('./globals.php');

// ------- Actual execution -------------------------------------------------------------
$router = new Router();

// General endpoitns
$router->add(new Endpoint('GET', '/users', UserController::class, 'show'));
$router->add(new Endpoint('GET', '/learningpath', LearingPathController::class, 'show'));
$router->add(new Endpoint('POST', '/learingpath', LearingPathController::class, 'create'));

// Autentication related
$router->add(new Endpoint('POST', '/users', UserController::class, 'create', false));
$router->add(new Endpoint('POST', '/sessions', SessionController::class, 'login', false));
$router->add(new Endpoint('DELETE', '/sessions', SessionController::class, 'logout', true));

try {
  $res = $router->handleRequest();
  http_response_code($res->statusCode);
  echo json_encode($res->body);
} catch (Exception $e) {
  $GLOBALS['serverError']($e);
}
