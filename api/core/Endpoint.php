<?php
class Endpoint
{
  public string $route;
  public string $httpMethod;
  public $controller;
  public $method;

  public function __construct(string $route, string $httpMethod, $controller, $method) {
    $this->route = $route; 
    $this->httpMethod = $httpMethod;
    $this->controller = $controller;
    $this->method = $method;
  }
}
