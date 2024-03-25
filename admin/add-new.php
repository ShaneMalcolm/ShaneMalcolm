<?php

require_once("../connection.php");

class DoctorFormHandler
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

        $this->handleFormSubmission();
    }

    private function isLoggedInAsAdmin()
    {
        return isset($_SESSION["user"]) && $_SESSION["user"] !== "" && $_SESSION['usertype'] === 'a';
    }

    private function handleFormSubmission()
    {
        if ($_POST) {
            $name = $_POST['name'];
            $nic = $_POST['nic'];
            $spec = $_POST['spec'];
            $email = $_POST['email'];
            $tele = $_POST['Tele'];
            $password = $_POST['password'];
            $cpassword = $_POST['cpassword'];

            if ($password == $cpassword) {
                $result = $this->database->query("SELECT * FROM webuser WHERE email='$email';");
                if ($result->num_rows == 1) {
                    $error = '1';
                } else {
                    $sql1 = "INSERT INTO doctor (docemail, docname, docpassword, docnic, doctel, specialties) VALUES ('$email','$name','$password','$nic','$tele',$spec);";
                    $sql2 = "INSERT INTO webuser VALUES ('$email','d')";
                    $this->database->query($sql1);
                    $this->database->query($sql2);
                    $error = '4';
                }
            } else {
                $error = '2';
            }
        } else {
            $error = '3';
        }

        header("location: doctors.php?action=add&error=" . $error);
        exit; 
    }
}

$doctorFormHandler = new DoctorFormHandler();

?>
