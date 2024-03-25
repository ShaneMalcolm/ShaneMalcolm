<?php
require_once('Classes/DoctorManager.php'); // Include the DoctorManager class file

if ($_GET) {
    $id = $_GET["id"];
    $action = $_GET["action"];
    $doctorManager = new DoctorManager(); // Create an instance of the DoctorManager class

    if ($action == 'drop') {
        // Handle drop action
        $nameget = $_GET["name"];
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2>Are you sure?</h2>
                    <a class="close" href="doctors.php">&times;</a>
                    <div class="content">
                        You want to delete this record<br>(' . substr($nameget, 0, 40) . ').
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <a href="delete-doctor.php?id=' . $id . '" class="non-style-link">
                            <button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">
                                <font class="tn-in-text">&nbsp;Yes&nbsp;</font>
                            </button>
                        </a>&nbsp;&nbsp;&nbsp;
                        <a href="doctors.php" class="non-style-link">
                            <button class="btn-primary btn" style="display: flex;justify-content: center;align-items: center;margin:10px;padding:10px;">
                                <font class="tn-in-text">&nbsp;&nbsp;No&nbsp;&nbsp;</font>
                            </button>
                        </a>
                    </div>
                </center>
            </div>
        </div>
        ';
    } elseif ($action == 'view') {
        // Handle view action
        $doctorManager->viewDoctorDetails($id);
    } elseif ($action == 'add') {
        // Handle add action
        $error_1 = $_GET["error"];
        $doctorManager->addDoctorForm($error_1);
    } elseif ($action == 'edit') {
        // Handle edit action
        $error_1 = $_GET["error"];
        $doctorManager->editDoctorForm($id, $error_1);
    }
}
?>
