<?php

require $_SERVER['DOCUMENT_ROOT'] . "\method\MethodController.php";

use Repository\MethodController;

$controller = new MethodController("participant");
$controller->handleRequest();
$title = $controller->parent->name;
$children = unserialize($controller->getSegments()->children);

require_once $_SERVER['DOCUMENT_ROOT'] . "\\" . "repository\departmentTemplate.php";
