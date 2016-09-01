<?php require PATH . 'views/header.php'; ?>

<div class="row">
  <div class="col-md-1">Id</div>
  <div class="col-md-2">Login</div>
  <div class="col-md-2">Password</div>
  <div class="col-md-1">Role</div>
</div>

<?php foreach ($users as $key => $value): ?>

  <div class="row">
    <div class="col-md-1"><?php echo $value['id'] ?></div>
    <div class="col-md-2"><?php echo $value['login'] ?></div>
    <div class="col-md-2"><?php echo $value['password'] ?></div>
    <div class="col-md-1"><?php echo $value['role'] ?></div>
    <div class="col-md-1"><a href="<?php echo URL . 'users/edit/' . $value['id'] ?>">Edit</a></div>
    <div class="col-md-1"><a href="<?php echo URL . 'users/delete/' . $value['id'] ?>">Delete</a></div>
  </div>


<?php endforeach; ?>

<div class="row">
  <form action="<?php echo URL ?>users/create" method="post">
    <label>Login: </label><input type="text" name="login">
    <label>Password: </label><input type="text" name="password">
    <label>Role: </label><select name="role">
      <option value="guest">Guest</option>
      <option value="admin">Admin</option>
      <option value="owner">Owner</option>
    </select>
    <input type="submit">
  </form>
</div>

<?php require PATH . 'views/footer.php'; ?>
