<?php

class Response
{
  public int $statusCode;
  public array $body;

  public function __construct(int $statusCode, array $body)
  {
    $this->statusCode = $statusCode;
    $this->body = $body;
  }
}
