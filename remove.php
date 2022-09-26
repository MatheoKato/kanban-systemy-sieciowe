<?php

require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(isset($_POST['id'])){
    $id = $_POST['id'];

    $sqld = "DELETE FROM `tasks` WHERE `id` = '$id'";
    if($result = @$link->query($sqld)){
        echo 1;

    }else{
        echo 0;
    }
    
    $link->close();
    $link = null;
}
?>