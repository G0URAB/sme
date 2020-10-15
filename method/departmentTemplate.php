<?php

require $_SERVER['DOCUMENT_ROOT'] . "\\repository\Controller.php";

use Repository\Controller;

$controller = new Controller("participant");
$controller->handleRequest();
$title = $controller->parent->name;
$children = unserialize($controller->getSegments()->children);

require_once $_SERVER['DOCUMENT_ROOT'] . "\\" . "repository\departmentTemplate.php";
