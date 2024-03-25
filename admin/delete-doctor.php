<?php

// Include the necessary files and classes
require_once("../connection.php");

class DoctorManager
{
    private $database;

    public function __construct()
    {
        session_start();
        $this->database = $GLOBALS['database'];

        if (!$this->isLoggedInAsAdmin()) {
            header("location: ../login.php");
            exit;
        }
    }

    private function isLoggedInAsAdmin()
    {
        return isset($_SESSION["user"]) && $_SESSION["user"] !== "" && $_SESSION['usertype'] === 'a';
    }

    public function deleteDoctor($id)
    {
        $result001 = $this->database->query("SELECT * FROM doctor WHERE docid=$id;");
        $email = ($result001->fetch_assoc())["docemail"];

        $this->database->query("DELETE FROM webuser WHERE email='$email';");
        $this->database->query("DELETE FROM doctor WHERE docemail='$email';");

        header("location: doctors.php");
        exit;
    }
}

// Instantiate the DoctorManager class and perform the delete operation if $_GET data exists
$doctorManager = new DoctorManager();
if ($_GET && isset($_GET["id"])) {
    $doctorManager->deleteDoctor($_GET["id"]);
}

?>
