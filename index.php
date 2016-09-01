<?php

define('URL', 'http://10.0.0.6/');
define('PATH', 'C:/xampp/htdocs/simple/');

require_once PATH . 'libs/Db.php';

$controllerName = 'IndexController';
$methodName = 'index';
$param = FALSE;

if (isset($_GET['url'])) {
  $url = explode('/', trim($_GET['url'], '/'));
  $controllerName = ucfirst($url[0]) . 'Controller';
  if (isset($url[1])) {
    $methodName = $url[1];
  }
  if (isset($url[2])) {
    $param = $url[2];
  }
}
$file = PATH . 'controllers/' . $controllerName . '.php';
if (file_exists($file)) {
  require_once $file;
  $app = new $controllerName();
  if (method_exists($app, $methodName)) {
    $app->$methodName($param);
  } else {
    $error = 'Method "<i class="label-danger">' . $methodName . '</i>" not found';
    require_once PATH . 'views/error.php';
  }
} else {
  $error = 'Controller "<i class="label-danger">' . $controllerName . '</i>" not found';
  require_once PATH . 'views/error.php';
}
