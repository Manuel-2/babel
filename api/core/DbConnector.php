<?php
class DbConnector
{
  private static ?DbConnector $sharedInstance = null;
  private PDO $con;

  private function __construct()
  {
    $this->connect2Database();
  }

  public static function getInstance(): DbConnector
  {
    if (!self::$sharedInstance) {
      self::$sharedInstance = new DbConnector();
    }
    return self::$sharedInstance;
  }

  private function connect2Database()
  {
    $dbConfig = $GLOBALS['config']->db;
    $host = $dbConfig->host;
    $dbname = $dbConfig->name;
    $user = $dbConfig->user;
    $password = $dbConfig->password;

    $url = "mysql:host=$host;dbname=$dbname";
    try {
      $this->con = new PDO($url, $user, $password);
    } catch (PDOException $e) {
      $GLOBALS['serverError']($e);
    }
  }

  public static function statement(string $sql)
  {
    $db = self::getInstance();
    $statement = $db->con->prepare($sql);
    $statement->execute();

    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public static function statementWithParams(string $sql, array $params)
  {
    $db = self::getInstance();
    $statement = $db->con->prepare($sql);
    $statement->execute($params);

    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $data;
  }

  public static function insertStatement(string $sql, $params)
  {
    $db = self::getInstance();
    $statement = $db->con->prepare($sql);
    $statement->execute($params);
    $id = $db->con->lastInsertId();
    return $id;
  }
}
