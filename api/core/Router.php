<?php

class Router
{
  private array $endpoints;

  public function __construct()
  {
    $this->endpoints = [];
  }

  public function endpoint(Endpoint $endpoint)
  {
    $this->endpoints[$endpoint->route] = $endpoint;
  }

  public function handleRequest()
  {
    $reqRoute = $_SERVER["REQUEST_URI"];
    $reqRoute = explode("/api", $reqRoute)[1];

    $endpoint = $this->endpoints[$reqRoute];

    $message = "Error: Endpoint no Existe LOL\n";
    $statusCode = 404;

    if (isset($endpoint)) {
      $controller = $endpoint->controller;
      $method2Call = $endpoint->method;

      $statusCode = 203;
      if (method_exists($controller, $method2Call)) {
        $message = 'TODO BiENNN :)';
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
