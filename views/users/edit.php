<?php require PATH . 'views/header.php'; ?>

<div class="row">
  <form action="<?php echo URL.'users/update/'.$user['id'] ?>" method="post">
    <label>Login: </label><input type="text" name="login" value="<?php echo $user['login'] ?>">
    <label>Password: </label><input type="text" name="password" value="<?php echo $user['password'] ?>">
    <label>Role: </label><select name="role">
      <?php if ($user['role'] == 'guest'): ?>
        <option value="guest" selected>Guest</option>
        <option value="admin">Admin</option>
        <option value="owner">Owner</option>
      <?php elseif ($user['role'] == 'admin'): ?>
        <option value="guest">Guest</option>
        <option value="admin" selected>Admin</option>
        <option value="owner">Owner</option>
      <?php elseif ($user['role'] == 'owner'): ?>
        <option value="guest">Guest</option>
        <option value="admin">Admin</option>
        <option value="owner" selected>Owner</option>
      <?php endif; ?>
    </select>
    <input type="submit">
  </form>
</div>

<?php require PATH . 'views/footer.php'; ?>
