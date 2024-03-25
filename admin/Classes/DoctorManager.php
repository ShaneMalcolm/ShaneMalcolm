<?php
class DoctorManager {
    private $database;

    public function __construct() {
        // Initialize database connection
        $this->database = new mysqli("localhost", "root", "", "edoc");

        // Check connection
        if ($this->database->connect_error) {
            die("Connection failed: " . $this->database->connect_error);
        }
    }

    public function viewDoctorDetails($id) {
        // Handle view action
        $sqlmain = "SELECT * FROM doctor WHERE docid='$id'";
        $result = $this->database->query($sqlmain);
        $row = $result->fetch_assoc();
        $name = $row["docname"];
        $email = $row["docemail"];
        $spe = $row["specialties"];

        $spcil_res = $this->database->query("SELECT sname FROM specialties WHERE id='$spe'");
        $spcil_array = $spcil_res->fetch_assoc();
        $spcil_name = $spcil_array["sname"];
        $nic = $row['docnic'];
        $tele = $row['doctel'];

        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <h2></h2>
                    <a class="close" href="doctors.php">&times;</a>
                    <div class="content">
                        eDoc Web App<br>
                    </div>
                    <div style="display: flex;justify-content: center;">
                        <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                            <tr>
                                <td>
                                    <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">View Details.</p><br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="name" class="form-label">Name: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $name . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Email" class="form-label">Email: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $email . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="nic" class="form-label">NIC: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $nic . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="Tele" class="form-label">Telephone: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $tele . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    <label for="spec" class="form-label">Specialties: </label>
                                </td>
                            </tr>
                            <tr>
                                <td class="label-td" colspan="2">
                                    ' . $spcil_name . '<br><br>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <a href="doctors.php"><input type="button" value="OK" class="login-btn btn-primary-soft btn" ></a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </center>
                <br><br>
            </div>
        </div>
        ';
    }

    public function addDoctorForm($error_1) {
        // Handle add action
        $errorlist= array(
            '1'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
            '2'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
            '3'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
            '4'=>"",
            '0'=>'',
    
        );
    
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <a class="close" href="doctors.php">&times;</a> 
                    <div style="display: flex;justify-content: center;">
                        <div class="abc">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                    <td class="label-td" colspan="2">'.
                                        $errorlist[$error_1]
                                    .'</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Add New Doctor.</p><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <form action="add-new.php" method="POST" class="add-new-form">
                                        <td class="label-td" colspan="2">
                                            <label for="name" class="form-label">Name: </label>
                                        </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" name="name" class="input-text" placeholder="Doctor Name" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="Email" class="form-label">Email: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="nic" class="form-label">NIC: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" name="nic" class="input-text" placeholder="NIC Number" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="Tele" class="form-label">Telephone: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="spec" class="form-label">Choose specialties: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <select name="spec" id="" class="box">';
    
        $list11 = $this->database->query("select  * from  specialties order by sname asc;");
    
        for ($y=0;$y<$list11->num_rows;$y++){
            $row00=$list11->fetch_assoc();
            $sn=$row00["sname"];
            $id00=$row00["id"];
            echo "<option value=".$id00.">$sn</option><br/>";
        }
    
        echo '      </select><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="password" class="form-label">Password: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="cpassword" class="form-label">Conform Password: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="submit" value="Add" class="login-btn btn-primary btn">
                                    </td>
                                </tr>
                            </form>
                        </tr>
                    </table>
                </div>
            </div>
        </center>
        <br><br>
        </div>
    </div>
    ';
    
    }
    
    public function editDoctorForm($id, $error_1) {
        // Handle edit action
        $sqlmain= "select * from doctor where docid='$id'";
        $result= $this->database->query($sqlmain);
        $row=$result->fetch_assoc();
        $name=$row["docname"];
        $email=$row["docemail"];
        $spe=$row["specialties"];
    
        $spcil_res= $this->database->query("select sname from specialties where id='$spe'");
        $spcil_array= $spcil_res->fetch_assoc();
        $spcil_name=$spcil_array["sname"];
        $nic=$row['docnic'];
        $tele=$row['doctel'];
    
        $errorlist= array(
            '1'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Already have an account for this Email address.</label>',
            '2'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;">Password Conformation Error! Reconform Password</label>',
            '3'=>'<label for="promter" class="form-label" style="color:rgb(255, 62, 62);text-align:center;"></label>',
            '4'=>"",
            '0'=>'',
        );
    
        echo '
        <div id="popup1" class="overlay">
            <div class="popup">
                <center>
                    <a class="close" href="doctors.php">&times;</a> 
                    <div style="display: flex;justify-content: center;">
                        <div class="abc">
                            <table width="80%" class="sub-table scrolldown add-doc-form-container" border="0">
                                <tr>
                                    <td class="label-td" colspan="2">'.
                                        $errorlist[$error_1]
                                    .'</td>
                                </tr>
                                <tr>
                                    <td>
                                        <p style="padding: 0;margin: 0;text-align: left;font-size: 25px;font-weight: 500;">Edit Doctor Details.</p>
                                        Doctor ID : '.$id.' (Auto Generated)<br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <form action="edit-doc.php" method="POST" class="add-new-form">
                                        <td class="label-td" colspan="2">
                                            <label for="Email" class="form-label">Email: </label>
                                            <input type="hidden" value="'.$id.'" name="id00">
                                            <input type="hidden" name="oldemail" value="'.$email.'" >
                                        </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="email" name="email" class="input-text" placeholder="Email Address" value="'.$email.'" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="name" class="form-label">Name: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" name="name" class="input-text" placeholder="Doctor Name" value="'.$name.'" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="nic" class="form-label">NIC: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="text" name="nic" class="input-text" placeholder="NIC Number" value="'.$nic.'" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="Tele" class="form-label">Telephone: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="tel" name="Tele" class="input-text" placeholder="Telephone Number" value="'.$tele.'" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="spec" class="form-label">Choose specialties: (Current'.$spcil_name.')</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <select name="spec" id="" class="box">';
    
        $list11 = $this->database->query("select  * from  specialties;");
    
        for ($y=0;$y<$list11->num_rows;$y++){
            $row00=$list11->fetch_assoc();
            $sn=$row00["sname"];
            $id00=$row00["id"];
            echo "<option value=".$id00.">$sn</option><br/>";
        }
    
        echo '      </select><br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="password" class="form-label">Password: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="password" name="password" class="input-text" placeholder="Defind a Password" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <label for="cpassword" class="form-label">Conform Password: </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="label-td" colspan="2">
                                        <input type="password" name="cpassword" class="input-text" placeholder="Conform Password" required><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <input type="reset" value="Reset" class="login-btn btn-primary-soft btn" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="submit" value="Save" class="login-btn btn-primary btn">
                                    </td>
                                </tr>
                            </form>
                        </tr>
                    </table>
                </div>
            </div>
        </center>
        <br><br>
        </div>
    </div>
    ';
    }
    

    public function __destruct() {
        // Close database connection when the object is destroyed
        $this->database->close();
    }
}

// Include the DoctorManager class file
require_once('DoctorManager.php');

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
