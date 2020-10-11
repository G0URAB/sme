<?php

namespace Meta;

interface RequestInterface{

    public function getRequestType();
    public function get($member);

}