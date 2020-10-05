<?php

namespace Meta;

interface ControllerInterface{

    public function index();
    public function create();
    public function update(int $id, string $segmentType);
    public function delete(int $id, string $segmentType);
    public function getTemplate();
    public function setTemplate(string $template);
}