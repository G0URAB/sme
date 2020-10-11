<?php

namespace Meta;

interface ControllerInterface{

    public function index();
    public function create();
    public function update($id);
    public function delete($id);
    public function getBaseTemplate();
    public function setBaseTemplate($template);
    public function getOrganizationTemplate();
    public function setOrganizationTemplate($template);
    public function getDepartmentTemplate();
    public function setDepartmentTemplate($template);
    public function getSegment();
    public function setSegment($segment);
    public function getSegmentType();
    public function setSegmentType($type);
}