<?php

namespace Repository;

require_once $_SERVER['DOCUMENT_ROOT'] . "\\" . "repository\AbstractSegment.php";
use Repository\AbstractSegment;

Class Organization extends AbstractSegment {

    /* Return an associative array to be used by a database manager */
    function toArray()
    {
        return [
            'id'=>$this->getId(),
            'name'=>$this->getName(),
            'parent'=>$this->getParent(),
            'children'=>$this->getChildren(),
        ];
    }
}