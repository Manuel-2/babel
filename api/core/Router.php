<?php

class Router
{
  private array $endpoints;

  public function __construct()
  {
    $this->endpoints = [];
  }

  public function add(Endpoint $endpoint)
  {
    $endpointKey = "$endpoint->httpMethod:$endpoint->route";
    $this->endpoints[$endpointKey] = $endpoint;
  }

  public function handleRequest()
  {
    $reqRoute = $_SERVER["REQUEST_URI"];
    $reqRoute = explode("/api", $reqRoute)[1];
    // validar que no pasen cosas raras con rutas con slashes raros , curar la entrada

    $reqMethod = $_SERVER['REQUEST_METHOD'];
    $endpointKey = "$reqMethod:$reqRoute";

    $endpoint = $this->endpoints[$endpointKey];


    session_start();
    // Autentication
    if ($endpoint->auth) {
      if (isset($_SESSION['autenticated']) == false) {
        return new Response(401, ['message' => "Nececitas acceder para solicitar el recurso"]);
      }
    }

    $message = "Error el Endpoint \"$endpointKey\" no existe";
    $statusCode = 404;
    if (isset($endpoint)) {
      $controller = $endpoint->controller;
      $method2Call = $endpoint->method;
      if (method_exists($controller, $method2Call)) {
        return $controller[$method2Call]();
      } else {
        $statusCode = 500;
        $message = 'El servidor exploto, Babel dejo de funcionar sorry 错误 エラー 오류ошибк خطأ त्रुट erreur गलती';
        if ($GLOBALS['config']->apiMode == "debug") {
          $message = 'El controlador: "' . get_class($controller) .  "\" no tiene el metodo: \"$method2Call()\"";
        }
      }
    }
    return new Response($statusCode, ['message' => $message]);
  }
}
