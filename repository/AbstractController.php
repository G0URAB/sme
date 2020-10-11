<?php

namespace Repository;

require $_SERVER['DOCUMENT_ROOT']."\meta\ControllerInterface.php";

use Meta\ControllerInterface;

abstract Class AbstractController implements ControllerInterface
{

    private $baseTemplate;
    private $organizationTemplate;
    private $departmentTemplate;
    private $segment;
    private $segments;
    private $segmentType;

    abstract public function redirect($template);
    abstract public function getTemplateToRedirect();
    abstract public function handleRequest();
    abstract public function getManager();

    public function getBaseTemplate()
    {
        return $this->baseTemplate;
    }

    public function setBaseTemplate($template)
    {
        $this->baseTemplate=$template;
    }

    public function getOrganizationTemplate()
    {
        return $this->organizationTemplate;
    }

    public function setOrganizationTemplate($template)
    {
        $this->organizationTemplate=$template;
    }

    public function getDepartmentTemplate()
    {
        return $this->departmentTemplate;
    }

    public function setDepartmentTemplate($template)
    {
        $this->departmentTemplate=$template;
    }

    public function getSegment()
    {
        return $this->segment;
    }

    public function setSegment($segment)
    {
        $this->segment = $segment;
    }

    public function getSegmentType()
    {
        return $this->segmentType;
    }

    public function setSegmentType($type)
    {
        $this->segmentType=$type;
    }


    public function getSegments()
    {
        return $this->segments;
    }

    public function setSegments($segments): void
    {
        $this->segments = $segments;
    }

}