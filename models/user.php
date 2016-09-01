<?php

class User {

  public static function getUsersList() {
    $db = Db::dbConnect();
    $tableName = "users";
    $sth = $db->prepare("SELECT * FROM $tableName");
    $sth->execute();
    $users = $sth->fetchAll(2);
    return $users;
  }

  public static function createUser($data) {
    $db = Db::dbConnect();
    $sth = $db->prepare("INSERT INTO users (login, password, role) "
            . "VALUES (:login, :password, :role)");
    $sth->execute([
        ':login' => $data['login'],
        ':password' => $data['password'],
        ':role' => $data['role']
    ]);
  }

  public static function editUser($id) {
    $db = Db::dbConnect();
    $sth = $db->prepare("SELECT * FROM users WHERE id = :id");
    $sth->execute([':id' => $id]);
    return ($sth->fetch(2));
  }

  public static function updateUser($id, $data) {
    $db = Db::dbConnect();
    $sth = $db->prepare("UPDATE users SET login = :login, password = :password, role = :role WHERE id = :id");
    $sth->execute([
        ':id' => $id,
        ':login' => $data['login'],
        ':password' => $data['password'],
        ':role' => $data['role']
    ]);
    return ($sth->fetch(2));
  }

  public static function deleteUser($id) {
    $db = Db::dbConnect();
    $sth = $db->prepare("DELETE FROM users WHERE id=:id");
    $sth->execute([
        ':id' => $id
    ]);
  }

}
