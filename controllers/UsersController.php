<?php

class UsersController {

  function __construct() {
    require_once PATH . 'models/user.php';
  }

  public function index() {
    $users = User::getUsersList();
    require PATH . 'views/users/index.php';
  }

  public function create() {
    if (isset($_POST) && !empty($_POST['login']) && !empty($_POST['password'])) {
      User::createUser($_POST);
      header("location: " . URL . "users/");
    } else {
      echo "Заполните все поля";
    }
  }

  public function edit($id) {
    $user = User::editUser($id);
    require PATH . 'views/users/edit.php';
  }

  public function update($id) {
    if (isset($_POST) && !empty($_POST['login']) && !empty($_POST['password'])) {
      User::updateUser($id, $_POST);
      header("location: " . URL . "users/");
    } else {
      echo "Заполните все поля";
    }
  }

  public function delete($id) {
    $user = User::deleteUser($id);
    header("location: " . URL . "users/");
  }

}
