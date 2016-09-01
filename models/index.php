<?php

class Index {

  function __construct() {
    
  }

  public static function getOrdersList() {
    $db = Db::dbConnect();
    $sth = $db->prepare("SELECT tank FROM orders");
    $sth->execute();
    return $orders = $sth->fetchAll(2);
  }

  public static function createOrder($data) {
    $db = Db::dbConnect();
    $sth = $db->prepare("INSERT INTO orders (tank, staff, client_name, client_phone) "
            . "VALUES (:tank, :staff, :client_name, :client_phone)");
    $sth->execute([
        ':tank' => $data['tank'],
        ':staff' => $data['staff'],
        ':client_name' => $data['client_name'],
        ':client_phone' => $data['client_phone']
    ]);
  }
}
