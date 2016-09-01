<?php

class OrdersController {

  function __construct() {
    require_once PATH . 'models/order.php';
  }

  public function index() {
    $orders = Order::getOrdersList();
    $tanks = Order::getDistinctList('tank');
    $clientNames = Order::getDistinctList('client_name');
    $clientPhones = Order::getDistinctList('client_phone');
    require PATH . "views/orders/index.php";
  }

  public function create() {
    if (isset($_POST) && !empty($_POST['tank'])) {
      Order::createOrder($_POST);
      header("location: " . URL . "orders/");
    } else {
      echo "Заполните все поля";
    }
  }

  public function edit($id) {
    $order = Order::editOrder($id);
    $tanks = Order::getDistinctList('tank');
    $clientNames = Order::getDistinctList('client_name');
    $clientPhones = Order::getDistinctList('client_phone');
    require_once PATH . 'views/orders/edit.php';
  }

  public function update() {
    if (isset($_POST) && !empty($_POST['tank'])) {
      Order::updateOrder($_POST);
      header("location: " . URL . "orders/");
    } else {
      echo "Заполните все поля";
    }
  }
  
  public function delete($id) {
    Order::deleteOrder($id);
    header("location: " . URL . "orders/");
  }

}
