<?php

class Account
{
    // Podstawowe dane
    public $nick;
    private $email;
    private $id;

    // Konstruktor
    public function __construct($nick , $email , $id)
    {
        $this->nick  = $nick;
        $this->email = $email;
        $this->id    = $id;
    }

    public function GetUserId()
    {   return $this->id;   }
    
}
?>