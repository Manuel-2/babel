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
      $sql = "INSERT INTO users (name, email, password, recovery_token)
                VALUES (:name, :email, :password, :recovery_token)";

      $id = DbConnector::insertStatement($sql, [
        'name' => $this->name,
        'email' => $this->email,
        'password' => $hash,
        'recovery_token' => $recoveryToken
      ]);

      $this->id = $id;
    } catch (Exception $e) {
      $GLOBALS['serverError']($e);
    }
  }

  public function getLearingPath(){
    return "pendiente implementar"; 
  }

  public static function findUserByEmail($email)
  {
    $result = DbConnector::statement("select * from users where users.email = \"$email\"");
    return $result[0];
  }

  public static function getPasswordHashByEmail($email)
  {
    $result = DbConnector::statement("select password from users where users.email = \"$email\"");
    return $result[0]['password'];
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
