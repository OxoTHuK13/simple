<?php

require PATH . 'views/header.php';

echo '<pre>';
print_r(Client::editClient($id));

require PATH . 'views/footer.php';
