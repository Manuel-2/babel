<?php
class Endpoint
{
  public string $route;
  public string $httpMethod;
  public $controller;
  public $method;
  public $auth;

  public function __construct(string $httpMethod, string $route, $controller, $method, bool $auth = true)
  {
    $this->route = $route;
    $this->httpMethod = $httpMethod;
    $this->controller = $controller;
    $this->method = $method;
    $this->auth = $auth;
  }
}
