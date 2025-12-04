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

// ------- setup global (config, and fuctions)-------------------------------------------
require('./globals.php');

// ------- Actual execution -------------------------------------------------------------
$router = new Router();

// General endpoitns
$router->add(new Endpoint('GET', '/users', UserController::class, 'showUser'));

// Autentication related
$router->add(new Endpoint('POST', '/users', UserController::class, 'create', false));
$router->add(new Endpoint('POST', '/session', $router, 'login', false));
$router->add(new Endpoint('DELETE', '/session', $router, 'logout', true));

try {
  $res = $router->handleRequest();
  http_response_code($res->statusCode);
  echo json_encode($res->body);
} catch (Exception $e) {
  $serverError($e->getMessage());
}
