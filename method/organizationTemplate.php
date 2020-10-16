<?php

require $_SERVER['DOCUMENT_ROOT'] . "\method\MethodController.php";

use Repository\MethodController;

$controller = new MethodController("department");
$parentId = $controller->getRequest()->get("parent-id");
$controller->handleRequest();
$title = $controller->parent->name;

require_once $_SERVER['DOCUMENT_ROOT']."\\"."repository\organizationTemplate.php";
