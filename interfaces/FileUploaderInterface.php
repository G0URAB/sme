<?php

namespace Meta;

interface FileUploaderInterface{

   public function rename($oldName):string;
   public function upload($newName,$location):string ;
}