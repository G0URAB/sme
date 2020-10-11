<?php

namespace Meta;

interface MailerInterface{

    public function setTo($to);
    public function setCC($cc);
    public function setFrom($from);
    public function setSubject($subject);
    public function setMessage($msg);
    public function setContentType($option);
    public function sendMail();
}