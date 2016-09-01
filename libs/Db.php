<?php

class Db {

  function __construct() {
    
  }

  public static function dbConnect() {
    $db = new PDO("mysql:host=localhost; dbname=simple; charset=utf8", 'root', '');
    return $db;
  }

}
