<?php

namespace Repository;

require $_SERVER['DOCUMENT_ROOT'] . "\interfaces\RequestInterface.php";
use Meta\RequestInterface;

class HttpRequest implements RequestInterface
{

    public $data;

    public function __construct()
    {
        $this->data = $_REQUEST;
    }

    public function getRequestType()
    {
        //Redirect to index
        if(empty($this->data))
            return "index";

        //Redirect to create
        else if(isset($this->data['create']))
            return "create";


        //Redirect to update
        else if(isset($this->data['update']))
            return "update";

        //Redirect to delete
        else if(isset($this->data['delete']))
            return "delete";

        //In all other cases redirect to index
        else return "index";
    }

    public function get($member)
    {
        if(isset(($this->data)[$member]))
            return ($this->data)[$member];
        else
            return null;
    }

}