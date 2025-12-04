<?php

class User
{
  public string $name;
  public string $email;
  public int $id;
  private string $recoveryToken;

  public function __construct($name, $email)
  {
    $this->name = $name;
    $this->email = $email;
  }

  public function save($password)
  {
    $recoveryToken = bin2hex(random_bytes(20));
    $hash = password_hash($password, PASSWORD_BCRYPT);

    try {
      $id = DbConnector::insertStatement("INSERT INTO users (name, email, password, recovery_token) VALUES ('$this->name', '$this->email', '$hash', '$recoveryToken')");
      $this->id = $id;
    } catch (Exception $e) {
      $GLOBALS['serverError']($e);
    }
  }

  // public static function findById($id): User
  // {
  // }

  public static function isEmailUnique($email)
  {
    $result = DbConnector::statement("select email from users where users.email = \"$email\"");
    return count($result) == 0;
  }
}
