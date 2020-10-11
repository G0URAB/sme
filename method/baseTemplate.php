<?php

require $_SERVER['DOCUMENT_ROOT']."\method\Controller.php";

use method\Controller;

$controller = new Controller();
$controller->setSegmentType("organization");
$controller->handleRequest();


require_once $_SERVER['DOCUMENT_ROOT']."\\"."repository\baseTemplate.php";
