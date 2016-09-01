<?php

class Order
{

  function __construct()
  {

  }

  public static function getOrdersList()
  {
    $db = Db::dbConnect();
    $sth = $db->prepare("SELECT * FROM orders");
    $sth->execute();
    return $orders = $sth->fetchAll(2);
  }

  public static function getDistinctList($fieldName)
  {
    $db = Db::dbConnect();
    $sth = $db->prepare("SELECT DISTINCT $fieldName FROM orders");
    $sth->execute();
    $orders = $sth->fetchAll(2);
    $list = "";
    foreach ($orders as $order) {
      $list .= "'" . $order["$fieldName"] . "', ";
    }
    $list .= "''";
    return $list;
  }

  public static function createOrder($data)
  {
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
  
  public static function editOrder($id) {
    $db = Db::dbConnect();
    $sth = $db->prepare("SELECT * FROM orders WHERE id = :id");
    $sth->execute([':id' => $id]);
    return $sth->fetch(2);
  }
  
  public static function updateOrder($data) {
    $db = Db::dbConnect();
    $sth = $db->prepare("UPDATE orders SET tank = :tank, staff = :staff, client_name = :client_name, client_phone = :client_phone WHERE id = :id");
    $sth->execute([
      ':tank' => $data['tank'],
      ':staff' => $data['staff'],
      ':client_name' => $data['client_name'],
      ':client_phone' => $data['client_phone'],
      ':id' => $data['id']
    ]);
  }
  
  public static function deleteOrder($id) {
    $db = Db::dbConnect();
    $sth = $db->prepare("DELETE FROM orders WHERE id = :id");
    $sth->execute([':id' => $id]);
  }
}
