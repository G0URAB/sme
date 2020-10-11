<?php

require $_SERVER['DOCUMENT_ROOT']."\method\Controller.php";

use method\Controller;

$controller = new Controller();
$controller->redirect($controller->getBaseTemplate());


