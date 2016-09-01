<?php require PATH . 'views/header.php'; ?>

<!--echo '<h1>Clients</h1>';-->

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th>#</th>
      <th>ФИО</th>
      <th>Паспорт</th>
      <th>Телефон</th>
      <th>E-mail</th>
      <th>Адрес</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($clients as $client): ?>
      <tr>
        <td><a href="<?php echo URL . 'clients/edit/' . $client['id'] ?>"><?php echo $client['id']; ?></a></td>
        <td><?php echo $client['name']; ?></td>
        <td><?php echo $client['series'] . ' ' . $client['number']; ?></td>
        <td>
          <?php
          $phones = explode(',', $client['phone']);
          foreach ($phones as $phone) {
            echo "<div><a href='tel:" . $phone . "'>" . $phone . "</a><div>";
          }
          ?></td>
        <td>
          <?php
          $emails = explode(',', $client['email']);
          foreach ($emails as $email) {
            echo "<div><a href='mailto:" . $email . "'>" . $email . "</a><div>";
          }
          ?>
        </td>
        <td><?php echo $client['city'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<a href="<?php echo URL . 'clients/newclient/' ?>">Создать клиента</a>

<?php
require PATH . 'views/footer.php';
