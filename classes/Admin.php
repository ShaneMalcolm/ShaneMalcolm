<?php
// classes/Admin.php

require_once 'User.php';

class Admin extends User {
    public function login($email, $password) {
        // Implement login logic for admins
    }

    public function signup($data) {
        // Implement signup logic for admins
    }

    public function createAccount($data, $database) {
        // Implement account creation logic for admins
    }
}
?>
