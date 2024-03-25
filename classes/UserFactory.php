<?php
// classes/UserFactory.php

require_once 'Patient.php'; // Import the Patient class
require_once 'Admin.php'; // Import the Admin class
require_once 'Doctor.php'; // Import the Doctor class

class UserFactory {
    public static function createUser($type) {
        switch ($type) {
            case 'patient':
                return new Patient();
            case 'admin':
                return new Admin();
            case 'doctor':
                return new Doctor();
            default:
                return null;
        }
    }
}
?>
