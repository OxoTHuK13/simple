<?php

class ClientsController {

  function __construct() {
    require_once PATH . 'models/client.php';
  }

  public function index() {
    $clients = Client::getClientsList();
    require_once PATH . 'views/clients/index.php';
  }

  public function newClient() {
    require_once PATH . 'views/clients/newclient.php';
  }

  public function create() {
    if (isset($_POST)) {
      Client::createClient($_POST);
//      header("location: " . URL . "clients/");
    } else {
      echo "Заполните поля клиента";
    }
  }

  public function edit($id) {
    $client = Client::editClient($id);
    require_once PATH . 'views/clients/editclient.php';
  }

  public function ajax() {
    $db = Db::dbConnect();
    $num = $_POST['number'];
    $sth = $db->prepare("SELECT phones.number, clients.name "
            . "FROM phones, clients "
            . "WHERE number LIKE :number "
            . "AND phones.client_id=clients.id");
    $sth->execute([
        ':number' => '%'.$num.'%'
    ]);
//    print_r($_POST);
    $name = $sth->fetch(2);
    echo $name['name'];
  }

}
