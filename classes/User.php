<?php
// classes/User.php

abstract class User {
    protected $email;
    protected $password;
    protected $type;

    abstract public function login($email, $password);
    abstract public function signup($data);
    abstract public function createAccount($data, $database);
}
?>
