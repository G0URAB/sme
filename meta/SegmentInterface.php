<?php

namespace Meta;

interface SegmentInterface{
    
    public function getId();
    public function SetId($id);
    public function getName();
    public function setName($name);
    public function getParent();
    public function setParent($parent);
    public function getChildren();
    public function setChildren($children);
}