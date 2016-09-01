<?php

class Client {

  private static $inputName;

  function __construct() {
    
  }

  public static function getClientsList() {
    $db = Db::dbConnect();
    $query = "SELECT c.id, c.name, ps.series, ps.number, "
            . "GROUP_CONCAT(DISTINCT ph.number SEPARATOR ',') phone, "
            . "GROUP_CONCAT(DISTINCT e.email SEPARATOR ',') email, ct.city "
            . "FROM clients c "
            . "LEFT JOIN passports ps ON c.passport_id = ps.id "
            . "LEFT JOIN phones ph ON c.id = ph.client_id "
            . "LEFT JOIN emails e ON c.id = e.client_id "
            . "LEFT JOIN cities ct ON c.address_id = ct.id "
            . "GROUP BY c.id";
    $sth = $db->prepare($query);
    $sth->execute();
    return $sth->fetchAll(2);
  }

  public static function createClient($data) {
    $db = Db::dbConnect();
    $passport_id = self::checkPassport($db, $data);
    $city_id = self::checkCity($db, $data);
    $sth = $db->prepare("INSERT INTO clients (name, passport_id, address_id) VALUES (:name, :passport, :address)");
    $sth->execute([
        ':name' => $data['name'],
        ':passport' => $passport_id,
        ':address' => $city_id
    ]);
    self::insertField($db, $data, "phone_", "phones", "number");
    self::insertField($db, $data, "email_", "emails", "email");

    $client = $db->query("SELECT name FROM clients ORDER BY id DESC LIMIT 1");
    $client = $client->fetch(2);
    echo $client['name'];
  }

  public static function checkPassport($db, $data) {
    if (!empty($data['passport_s']) and ! empty($data['passport_n'])) {
      $sth = $db->prepare("SELECT * FROM passports WHERE series = :series AND number = :number");
      $sth->execute([':series' => $data['passport_s'], ':number' => $data['passport_n']]);
      $passport = $sth->fetch(2);
      if ($passport) {
        return $passport['id'];
      } else {
        $sth = $db->prepare("INSERT INTO passports (series, number) VALUES (:series, :number)");
        $sth->execute([':series' => $data['passport_s'], ':number' => $data['passport_n']]);
        $passport = $db->query("SELECT MAX(ps.id) id FROM passports ps");
        $passport = $passport->fetch(2);
        return $passport['id'];
      }
    } else {
      $passport = 'NULL';
      return $passport;
    }
  }

  public static function checkCity($db, $data) {
    if (!empty($data['address'])) {
      $sth = $db->prepare("SELECT * FROM cities WHERE city = :city");
      $sth->execute([':city' => $data['address']]);
      $city = $sth->fetch(2);
      if ($city) {
        return $city['id'];
      } else {
        $sth = $db->prepare("INSERT INTO cities (city) VALUES (:city)");
        $sth->execute([':city' => $data['address']]);
        $city = $db->query("SELECT MAX(id) id FROM cities");
        $city = $city->fetch(2);
      }
    } else {
      $city['id'] = 'NULL';
    }
    return $city['id'];
  }

  /**
   * Inserts values into feilds of db's table
   * @param type $data get data from $_POST
   * @param type $inputName name of field of form
   * @param type $tableName name of table in db where values will be inserted
   * @param type $fieldName name of field of table
   */
  public static function insertField($db, $data, $inputName, $tableName, $fieldName) {
    self::$inputName = $inputName;
    $fields = array_filter($data, function($k) { // в массив $fiels заносим значения полей, имя которых содержит значение $inputName
      return $k == strpos($k, self::$inputName);
    }, ARRAY_FILTER_USE_KEY);
    $client = $db->query("SELECT MAX(id) id FROM clients");
    $client = $client->fetch(2);
    foreach ($fields as $value) {
      if ($value) {
        $sth = $db->query("SELECT $fieldName FROM $tableName WHERE $fieldName = '$value'");
        $sth = $sth->fetch(2);
        if (!$sth) {
          $sth = $db->prepare("INSERT INTO $tableName ($fieldName, client_id) VALUES (:fieldValue, :client_id)");
          $sth->execute([':fieldValue' => $value, ':client_id' => $client['id']]);
        }
      }
    }
  }

  public static function editClient($id) {
    $db = Db::dbConnect();
    $query = "SELECT c.id, c.name, ps.series, ps.number, "
            . "GROUP_CONCAT(DISTINCT ph.number SEPARATOR ',') phone, "
            . "GROUP_CONCAT(DISTINCT e.email SEPARATOR ',') email, "
            . "ct.city FROM clients c "
            . "LEFT JOIN passports ps ON c.passport_id = ps.id "
            . "LEFT JOIN phones ph ON c.id = ph.client_id "
            . "LEFT JOIN emails e ON c.id = e.client_id "
            . "LEFT JOIN cities ct ON c.address_id = ct.id "
            . "WHERE c.id = $id GROUP BY c.id";
    $sth = $db->prepare($query);
    $sth->execute();
    return $sth->fetch(2);
  }

}
