<?php require PATH . 'views/header.php'; ?>

<div>
  <form id="new_order" class="form-horizontal" role="form" action="<?php echo URL ?>orders/update" method="post">
    <div class="col-lg-6">
      <div class="form-group">
        <input type="text" placeholder="" disabled="" required class="form-control" id="id" name="id" value="<?php echo $order['id']; ?>">
      </div>
      <div class="form-group">
        <input type="text" placeholder="Наименование бака" required class="form-control" id="tank" name="tank" value="<?php echo $order['tank']; ?>">
      </div>
      <div class="form-group ">
        <input type="text" placeholder="Доп.комплектующие" class="form-control" name="staff" value="<?php echo $order['staff']; ?>">
      </div>
      <div class="form-group ">
        <input type="text" placeholder="ФИО клиента" class="form-control" id="client_name" name="client_name" value="<?php echo $order['client_name']; ?>">
      </div>
      <div class="form-group ">
        <input type="text" placeholder="Номер телефона" class="form-control" id="client_phone"
               name="client_phone" value="<?php echo $order['client_phone']; ?>">
      </div>
      <p class="pull-right">
        <input type="submit" id="submit">
      </p>
    </div>
  </form>
</div>
<div class="clearfix"></div>
<p><a id="delete" href="<?php echo URL . 'orders/delete/' . $order['id'] ?>">Delete</a></p>
<script>

  $(document).ready(function () {
    //Отключаем отправку формы по Enter и включаем по Ctrl+Enter
    $('.form-control').keypress(function (event) {
      if (event.keyCode == 10 || (event.ctrlKey && event.keyCode == 13)) {
        $('#submit').click();
        return false;
      } else if (event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });

    //Подтверждаем удаление
    $('#delete').on('click', function (e) {
      var c = confirm("Ты уверен?");
      if (c) {
        return true;
      } else {
        e.preventDefault();
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

  var tanks = [<?php echo $tanks; ?>];
  var clientNames = [<?php echo $clientNames; ?>];
  var clientPhones = [<?php echo $clientPhones; ?>];

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
