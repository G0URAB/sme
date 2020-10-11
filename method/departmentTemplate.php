<?php

require $_SERVER['DOCUMENT_ROOT']."\method\Controller.php";

use method\Controller;

$controller = new Controller();
$controller->setSegmentType("participant");
$controller->handleRequest();
$title = $controller->parent->name;
$children = unserialize($controller->getSegments()->children);
//var_dump($children);

require_once $_SERVER['DOCUMENT_ROOT'] . "\\" . "repository\departmentTemplate.php";
