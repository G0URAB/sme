<?php

namespace Repository;

require_once $_SERVER['DOCUMENT_ROOT'] . "\\" . "repository\AbstractSegment.php";
use Repository\AbstractSegment;

Class Participant extends AbstractSegment {

    private $image;
    private $description;

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }


    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }


    /* Return an associative array to be used by a database manager */
    function toArray()
    {
        return [
            'id'=>$this->getId(),
            'name'=>$this->getName(),
            'parent'=>$this->getParent(),
            'image'=>$this->getImage(),
        ];
    }
}