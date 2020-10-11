<?php

namespace method;

require $_SERVER['DOCUMENT_ROOT']."\\"."repository\AbstractManager.php";

use PDO;
use Repository\AbstractManager;

Class DatabaseManager extends AbstractManager {

    public function getChildrenOfParent($parentType, $parentId)
    {
        $stmt = $this->getConnection()->prepare('SELECT children FROM '.$parentType.' WHERE id = ? ');
        $stmt->execute([$parentId]);
        $result= $stmt->fetch(PDO::FETCH_OBJ);
        $stmt = null;

        return $result;
    }

}