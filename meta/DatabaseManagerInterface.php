<?php

namespace Meta;

interface DatabaseManagerInterface{

    public function getConnection();
    public function setConnection();
    public function deleteConnection();
    public function findAll();
    public function find($id);
    public function findOneBy(array $options);
    public function create();
    public function update($id);
    public function delete($id);

}