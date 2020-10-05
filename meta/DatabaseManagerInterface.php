<?php

namespace Meta;

interface DatabaseManagerInterface{

    public function getConnection();
    public function deleteConnection();
    public function find($id);
    public function findBy(array $options);
    public function create();
    public function update($id);
    public function delete($id);

}