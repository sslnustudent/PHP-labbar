<?php

require_once("..\LogIn\HTMLView.php");
require_once("..\LogIn\LogInController.php");

session_start();

$controller = new LogInController();
$htmlbody = $controller->doControll();

$view = new HTMLView();
$view->echoHTML($htmlbody);