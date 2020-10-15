<?php

require $_SERVER['DOCUMENT_ROOT'] . "\\repository\Controller.php";

use Repository\Controller;

$controller = new Controller("organization");
//$controller->setSegmentType("organization");
$controller->handleRequest();


require_once $_SERVER['DOCUMENT_ROOT']."\\"."repository\baseTemplate.php";
