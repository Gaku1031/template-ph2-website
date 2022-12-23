<?php
session_start();
define('ROOT_URL', 'http://localhost:8080/');
define('QUIZ_URL', 'http://localhost:8080/quiz');
define('USER_URL', 'http://localhost:8080/components/');

class Database {
  private static $db;

  static function get() {
      if(!isset(self::$db))
          self::$db = new PDO('mysql:host=db;dbname=posse', 'root', 'root');
          self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

      return self::$db;
  }
}
