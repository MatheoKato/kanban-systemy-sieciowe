<?php

require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

if(isset($_POST['id']) || isset($_POST['task_progress'])){
    $id = $_POST['id'];
    $task_progress = $_POST['task_progress'];
    $sqld = "UPDATE `tasks` SET `task_progress`='$task_progress' WHERE `id` = '$id'";
    if($result = @$link->query($sqld)){
        echo 1;
    }else{
        echo 0;
    }
    
    $link->close();
    $link = null;
}
?>