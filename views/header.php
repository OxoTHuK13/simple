<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=0.5, maximum-scale=2, user-scalable=yes">
  <meta name="description" content="Learning PHP">
  <meta name="author" content="Alexander Chubarkin">
  <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="<?php echo URL ?>public/css/custom.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <!--  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
  <script type="text/javascript" src="<?php echo URL ?>public/js/bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo URL ?>public/js/typeahead.bundle.js"></script>
  <script type="text/javascript" src="<?php echo URL ?>public/js/maskedinput.js"></script>
  <meta charset="UTF-8">
  <title>Simple</title>
</head>
<body>
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo URL ?>">Simple</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo URL . 'orders'; ?>">Заказы</a></li>
        <li><a href="<?php echo URL . 'tanks'; ?>">Баки</a></li>
        <li><a href="<?php echo URL . 'producing'; ?>">Производство</a></li>
        <li><a href="<?php echo URL . 'clients'; ?>">Клиенты</a></li>
        <li><a href="<?php echo URL . 'users'; ?>">Пользователи</a></li>
      </ul>
    </div>
  </div>
</div>
<div class="container">
