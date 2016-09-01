<?php

class IndexController
{

  function __construct()
  {
    require_once PATH . 'models/index.php';
  }

  public function index()
  {
    $orders = Index::getOrdersList();
    $tanks = "";
    foreach ($orders as $order) {
      $tanks .= "'" . $order['tank'] . "', ";
    }
    $tanks .= "''";
    require_once PATH . 'views/index/index.php';
  }

}
