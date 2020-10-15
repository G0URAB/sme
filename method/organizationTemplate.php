<?php

require $_SERVER['DOCUMENT_ROOT'] . "\\repository\Controller.php";

use Repository\Controller;

$controller = new Controller("department");
$parentId = $controller->getRequest()->get("parent-id");
$controller->handleRequest();
$title = $controller->parent->name;

require_once $_SERVER['DOCUMENT_ROOT']."\\"."repository\organizationTemplate.php";
