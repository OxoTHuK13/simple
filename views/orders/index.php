<?php require PATH . 'views/header.php'; ?>
<table class="table table-striped table-hover">
  <thead>
  <tr>
    <th>#</th>
    <th>Бак</th>
    <th>Комплектующие</th>
    <th>ФИО клиента</th>
    <th>Телефон</th>
    <th></th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($orders as $key => $value): ?>
    <tr>
      <td><a href="<?php echo URL . 'orders/edit/' . $value['id'] ?>"><?php echo $value['id']; ?></a></td>
      <td><?php echo $value['tank']; ?></td>
      <td><?php echo $value['staff']; ?></td>
      <td><?php echo $value['client_name']; ?></td>
      <td><?php echo $value['client_phone']; ?></td>
      <td></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<div class="panel-group" id="accordion">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" class="btn-block" data-parent="#accordion" href="#collapseOne">
          Новый Заказ
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse">
      <div class="panel-body" id="the-basics">
        <form id="new_order" class="form-horizontal" role="form" action="<?php echo URL ?>orders/create" method="post">
          <div class="col-lg-6">
            <div class="form-group">
              <input type="text" placeholder="Наименование бака" required class="form-control" id="tank" name="tank">
            </div>
            <div class="form-group ">
              <input type="text" placeholder="Доп.комплектующие" class="form-control" name="staff">
            </div>
            <div class="form-group ">
              <input type="text" placeholder="ФИО клиента" class="form-control" id="client_name" name="client_name">
            </div>
            <div class="form-group ">
              <input type="text" placeholder="Номер телефона" class="form-control" id="client_phone"
                     name="client_phone">
            </div>
            <p class="pull-right">
              <input type="submit" id="submit">
            </p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  //Отключаем отправку формы по Enter и включаем по Ctrl+Enter
  $(document).ready(function () {
    $('.form-control').keypress(function (event) {
      if (event.keyCode == 10 || (event.ctrlKey && event.keyCode == 13)) {
        $('#submit').click();
        return false;
      } else if (event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });

  var substringMatcher = function (strs) {
    return function findMatches(q, cb) {
      var matches, substringRegex;

      // an array that will be populated with substring matches
      matches = [];

      // regex used to determine if a string contains the substring `q`
      substrRegex = new RegExp(q, 'i');

      // iterate through the pool of strings and for any string that
      // contains the substring `q`, add it to the `matches` array
      $.each(strs, function (i, str) {
        if (substrRegex.test(str)) {
          matches.push(str);
        }
      });

      cb(matches);
    };
  };

  var tanks = [<?php echo $tanks;?>];
  var clientNames = [<?php echo $clientNames;?>];
  var clientPhones = [<?php echo $clientPhones;?>];

  $('#the-basics #tank').typeahead({
      hint: true,
      highlight: true,
      minLength: 3
    },
    {
      name: 'tank',
      source: substringMatcher(tanks)

    });

  $('#the-basics #client_name').typeahead({
      hint: true,
      highlight: true,
      minLength: 3
    },
    {
      name: 'clientName',
      source: substringMatcher(clientNames)
    });

  $('#the-basics #client_phone').typeahead({
      hint: true,
      highlight: true,
      minLength: 3
    },
    {
      name: 'clientPhone',
      source: substringMatcher(clientPhones)
    });
</script>

<?php require PATH . 'views/footer.php'; ?>
