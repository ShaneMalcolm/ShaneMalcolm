<?php

    session_start();

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='a'){
            header("location: ../api/login.php");
        }

    }else{
        header("location: ../api/login.php");
    }
    
    
    if($_GET){
        //import database
        include("../connection.php");
        $id=$_GET["id"];
        //$result001= $database->query("select * from schedule where scheduleid=$id;");
        //$email=($result001->fetch_assoc())["docemail"];
        $sql= $database->query("delete from schedule where scheduleid='$id';");
        //$sql= $database->query("delete from doctor where docemail='$email';");
        //print_r($email);
        header("location: schedule.php");
    }


?>