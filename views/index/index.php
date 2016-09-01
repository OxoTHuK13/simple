<?php require PATH . 'views/header.php'; ?>


<!-- Main component for a primary marketing message or call to action -->
<div class="jumbotron">
  <div id="the-basics">
    <form method="post" action="#">
      <input class="typeahead" type="text" placeholder="States of USA" name="state">
      <input type="submit">
    </form>
  </div>
</div>
<div class="jumbotron">
  <?php

  if ($_POST) {
    echo '<h2>'.$_POST['state'].'</h2>';
  }

  ?>
</div>

<script>
  var substringMatcher = function(strs) {
    return function findMatches(q, cb) {
      var matches, substringRegex;

      // an array that will be populated with substring matches
      matches = [];

      // regex used to determine if a string contains the substring `q`
      substrRegex = new RegExp(q, 'i');

      // iterate through the pool of strings and for any string that
      // contains the substring `q`, add it to the `matches` array
      $.each(strs, function(i, str) {
        if (substrRegex.test(str)) {
          matches.push(str);
        }
      });

      cb(matches);
    };
  };

//  var states = ['Alex', 'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California',
//    'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii',
//    'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana',
//    'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota',
//    'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire',
//    'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota',
//    'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island',
//    'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont',
//    'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming'
//  ];
  var states = [<?php echo $tanks ;?>];

  $('#the-basics .typeahead').typeahead({
      hint: true,
      highlight: true,
      minLength: 1
    },
    {
      name: 'states',
      source: substringMatcher(states)
    });
</script>
<?php require PATH . 'views/footer.php'; ?>
