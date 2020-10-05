<?php

namespace Meta;

interface SegmentInterface{
    
    public function getId();
    public function SetId();
    public function getName();
    public function setName();
    public function getParent();
    public function setParent();
    public function getChildren();
    public function setChildren();
}