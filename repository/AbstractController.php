<?php

namespace Repository;

require "meta\ControllerInterface.php";
require "meta\Template.php";


use Meta\ControllerInterface;

abstract Class AbstractController implements ControllerInterface
{

    private $defaultTemplate;

    public function __construct()
    {
        $this->defaultTemplate="meta\Template.php";
    }

    abstract public function routeRedirect();


    public function index()
    {
        header("Location:".$this->defaultTemplate);
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update($id,$segmentType)
    {
        // TODO: Implement update() method.
    }

    public function delete($id,$segmentType)
    {
        // TODO: Implement delete() method.
    }


    public function getTemplate()
    {
        return $this->defaultTemplate;
    }

    public function setTemplate(string $template)
    {
        $this->defaultTemplate = $template;
    }
}