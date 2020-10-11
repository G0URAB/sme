<?php

require $_SERVER['DOCUMENT_ROOT']."\method\Controller.php";

use method\Controller;

$controller = new Controller();
$controller->setSegmentType("department");
$parentId = $controller->getRequest()->get("parent-id");
$controller->handleRequest();
$title = $controller->parent->name;

require_once $_SERVER['DOCUMENT_ROOT']."\\"."repository\organizationTemplate.php";
