<?php

namespace Meta;

interface MailerInterface{

    public function setTo($newName,$location);
    public function setCC($newName,$location);
    public function setFrom($newName,$location);
    public function setSubject($newName,$location);
    public function setMessage($newName,$location);
    public function setContentType($newName,$location);
}