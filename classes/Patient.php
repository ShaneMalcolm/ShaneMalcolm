<?php
// classes/Patient.php

require_once 'User.php'; 

class Patient extends User {
    public function signup($data) {

        if(isset($_SESSION['personal'])) {
            $_SESSION["personal"] = array(
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                'address' => $data['address'],
                'nic' => $data['nic'],
                'dob' => $data['dob']
            );

            header("location: create-account.php");
            exit(); 
        } else {
            echo '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Personal information not found. Please sign up again.</label>';
        }
    }

    public function createAccount($data, $database) {

        $error = '';

        if(isset($_SESSION['personal'])) {
            $fname = $_SESSION['personal']['fname'];
            $lname = $_SESSION['personal']['lname'];
            $name = $fname . " " . $lname;
            $address = $_SESSION['personal']['address'];
            $nic = $_SESSION['personal']['nic'];
            $dob = $_SESSION['personal']['dob'];
            $email = $data['newemail'];
            $tele = $data['tele'];
            $newpassword = $data['newpassword'];
            $cpassword = $data['cpassword'];

            if ($newpassword == $cpassword) {

                $sqlmain = "SELECT * FROM webuser WHERE email=?";
                $stmt = $database->prepare($sqlmain);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>';
                } else {

                    $database->query("INSERT INTO patient(pemail,pname,ppassword, paddress, pnic,pdob,ptel) VALUES('$email','$name','$newpassword','$address','$nic','$dob','$tele');");
                    $database->query("INSERT INTO webuser VALUES('$email','p')");

                    $_SESSION["user"] = $email;
                    $_SESSION["usertype"] = "p";
                    $_SESSION["username"] = $fname;

                    header('Location: patient/index.php');
                    exit(); 
                }
            } else {
                $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconfirm Password</label>';
            }
        } else {
            $error = '<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Personal information not found. Please sign up again.</label>';
        }


        return $error;
    }

    public function login($email, $password) {
    }
}
?>
