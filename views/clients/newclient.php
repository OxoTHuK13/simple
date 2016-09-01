<?php require PATH . 'views/header.php'; ?>

<div class="">
  <form id="new_client" class="form-horizontal" role="form" action="<?php echo URL ?>clients/create" method="post">
    <div class="input-group">
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-user"></span>
      </span>
      <input type="text" placeholder="ФИО клиента" required class="form-control" id="name" name="name">
    </div>
    <div class="input-group">
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-book"></span>
      </span>
      <input type="text" placeholder="Серия паспорта" class="form-control" id="passport_S" name="passport_s">
    </div>
    <div class="input-group">
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-book"></span>
      </span>
      <input type="text" placeholder="№ паспорта" class="form-control" id="passport_n" name="passport_n">
    </div>
    <div>
      <div class="input-group">
        <span class="input-group-addon">
          <span class="glyphicon glyphicon-earphone"></span>
        </span>
        <input type="tel" placeholder="Телефон" class="form-control" id="phone_1" name="phone_1">
        <span class="input-group-addon">
          <strong>
            <a href="#" class="addfield" data-name="phone_" data-type="tel">+</a>
          </strong>
        </span>
      </div>
      <div class="alert alert-danger result"></div>
    </div>
    <div class="input-group">
      <span class="input-group-addon">
        <span class="glyphicon glyphicon-envelope"></span>
      </span>
      <input type="email" placeholder="E-mail" class="form-control" id="email_1" name="email_1">
      <span class="input-group-addon">
        <strong>
          <a href="#" class="addfield" data-name="email_" data-type="email">+</a>
        </strong>
      </span>
    </div>
    <div class="input-group">
      <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
      <input type="text" placeholder="Город" class="form-control" id="address" name="address">
    </div>
    <p class="pull-right">
      <input type="submit" id="submit">
    </p>
  </form>
</div>
<div class="layout"><div id="result"><h3>Пользователь </h3><h2></h2><h3> успешно создан</h3></div></div>

<script>
  $('input[type=tel]').mask("+79999999999");

  function addField() {
    event.preventDefault();
    var icon;
    var placeholder;
    var type = $(this).attr('data-type');
    var name = $(this).attr('data-name');
    var count = $('input[type=' + type + ']').length + 1;
    if (type === 'tel') {
      icon = 'earphone';
      placeholder = 'Телефон';
    } else {
      icon = 'envelope';
      placeholder = 'E-mail';
    }
    $(this).parent().parent().parent().parent().
            after("<div>\n\
                     <div class='input-group'>\n\
                       <span class='input-group-addon'>\n\
                         <span class='glyphicon glyphicon-" + icon + "'></span>\n\
                       </span>\n\
                       <input type='" + type + "' \n\
                              placeholder='" + placeholder + "' \n\
                              class='form-control' \n\
                              id='" + name + count + "' \n\
                              name='" + name + count + "'>\n\
                       <span class='input-group-addon'>\n\
                         <strong>\n\
                           <a href='#' class='addfield' data-name='" + name + "' data-type='" + type + "'>+</a>\n\
                         </strong>\n\
                       </span>\n\
                     </div>\n\
                     <div class='alert alert-danger result'></div>\n\
                   </div>");
    $('input[type=tel]').mask("+79999999999");
    $('#' + name + count).focus();
    $(this).parent().parent().remove();
    checkNumber();
  }

  function checkNumber() {
    $(document).on('change', 'input[type=tel]', function (e) {
//      var str = $(this).val();
//      var length = str.length;
//      if ((str[0] === '8') && (length === 11)) {
//        var newStr = '+7' + str[1] + str[2] + str[3] + str[4] + str[5] + str[6] + str[7] + str[8] + str[9] + str[10];
//        $(this).val(newStr);
//      }

      /** Проверка, существует ли в базе такой номер **/
      var msg = $(this);
      var x = msg.parent().parent().find('.result');
      $.post("/clients/ajax", {number: $(this).val()}, function (data) {
        if (data.length > 1) {
          x.html("Этот номер похож на номер клиента: <strong>" + data + "</strong>");
          x.slideDown('slow');
        } else {
          x.slideUp('slow');
          x.html("");
        }
      });
    });
  }

// Отправка данных при помощи Ajax
  $('#new_client').submit(function () {
    event.preventDefault();
    var msg = $(this).serialize();
    $.ajax({
      type: 'POST',
      url: "/clients/create",
      data: msg,
      success: function (data) {
        $('.layout').fadeIn('slow');
        $('#result>h2').html(data);
        setTimeout("document.location.href='/clients/'", 50000);
      },
      error: function (xhr, str) {
        alert('Error: ' + xhr.responseCode);
      }
    });
  });

  $('.layout').on('click', function () {
    $(this).fadeOut('slow', function () {
      document.location.href = '/clients/';
    });
  });

  $(document).on('click', '.addfield', addField);
  checkNumber();
</script>


<?php require PATH . 'views/footer.php'; ?>
