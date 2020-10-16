<?php

require $_SERVER['DOCUMENT_ROOT'] . "\method\MethodController.php";

use Repository\MethodController;

$controller = new MethodController("organization");
$controller->handleRequest();


require_once $_SERVER['DOCUMENT_ROOT']."\\"."repository\baseTemplate.php";
