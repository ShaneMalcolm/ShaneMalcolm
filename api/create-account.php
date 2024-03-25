<!-- api/create-account.php -->

<?php

require_once 'Database.php';
require_once '../classes/Patient.php';

// Initialize error variable
$error = '';

$database = new Database();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    session_start();

    // Create an instance of Patient class
    $patient = new Patient();

    // Call createAccount method and capture any error
    $error = $patient->createAccount($_POST, $database);

    // If there's no error, proceed to create the user
    if (empty($error)) {
        require_once '../classes/UserFactory.php';

        // Create user object using Factory
        $user = UserFactory::createUser("patient");

        // Call createAccount method
        if ($user !== null) {
            $user->createAccount($_POST, $database);
        } else {
            $error = "Invalid user";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/animations.css">  
    <link rel="stylesheet" href="css/main.css">  
    <link rel="stylesheet" href="css/signup.css">
        
    <title>Create Account</title>
</head>
<body>
    <center>
    <div class="container">
        <table border="0" style="width: 69%;">
            <tr>
                <td colspan="2">
                    <p class="header-text">Let's Get Started</p>
                    <p class="sub-text">Let's create your User Account.</p>
                </td>
            </tr>
            <tr>
                <form action="" method="POST" >
                    <td class="label-td" colspan="2">
                        <label for="newemail" class="form-label">Email: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="email" name="newemail" class="input-text" placeholder="Email Address" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="tele" class="form-label">Mobile Number: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="tel" name="tele" class="input-text"  placeholder="ex: 0712345678" pattern="[0]{1}[0-9]{9}" >
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="newpassword" class="form-label">Create New Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" name="newpassword" class="input-text" placeholder="New Password" required>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <label for="cpassword" class="form-label">Confirm Password: </label>
                    </td>
                </tr>
                <tr>
                    <td class="label-td" colspan="2">
                        <input type="password" name="cpassword" class="input-text" placeholder="Confirm Password" required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php if(isset($error)) echo $error; ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >
                    </td>
                    <td>
                        <input type="submit" value="Sign Up" class="login-btn btn-primary btn">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <br>
                        <label for="" class="sub-text" style="font-weight: 280;">Already have an account&#63; </label>
                        <a href="login.php" class="hover-link1 non-style-link">Login</a>
                        <br><br><br>
                    </td>
                </tr>
                </form>
            </tr>
        </table>
    </div>
</center>
</body>
</html>
