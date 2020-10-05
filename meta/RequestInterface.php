<?php

namespace Meta;

interface RequestInterface{

    public function requestType();
    public function get($member);

}