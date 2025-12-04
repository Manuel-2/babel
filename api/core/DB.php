<?php
class DbConnector
{
  private static ?DbConnector $sharedInstance = null;
  private $dbConfig;
  private PDO $con;

  private function __construct($dbConfig)
  {
    $this->connect2Database($dbConfig);
  }

  public static function getInstance(): DbConnector
  {
    if (!self::$sharedInstance) {
      self::$sharedInstance = new DbConnector();
    }
    return self::$sharedInstance;
  }

  private function connect2Database($url,$user,$password)
  {
  
    $url = "mysql:host=$config->host;dbname=$config->database";
    try {
      $this->con = new PDO($url, $config->user, $config->password);
    } catch (PDOExeption $e) {
      die("Database connection error: $e->getMessage()");
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
}
