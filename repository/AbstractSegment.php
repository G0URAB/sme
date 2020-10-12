<?php

namespace Repository;

require $_SERVER['DOCUMENT_ROOT'] . "\interfaces\SegmentInterface.php";
use Meta\SegmentInterface;

abstract class AbstractSegment implements SegmentInterface{

    private $id;
    private $name;
    private $parent;
    private $children;

    public function getId()
    {
        return $this->id;
    }

    public function SetId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent= $parent;
    }

    public function getChildren()
    {
        return $this->children;
    }

    public function setChildren($children)
    {
        $this->children = $children;
    }

    abstract function toArray();
}