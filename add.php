<?php

require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


if(isset($_POST['title']) || isset($_POST['describe'])){
    $title = $_POST['title'];
    $describe = $_POST['describe'];
    $difficult = $_POST['difficult'];
    $username = $_SESSION['username'];

    if(empty($title) || empty($describe) ){
        header("Location: ../kanban/welcome.php?mess=error");
    }else{
        $sql = "INSERT INTO `tasks`(`title`, `describe`, `difficult`, `task_owner`, `task_progress`) VALUES ('$title','$describe','$difficult', '$username', 'todo')";
        if($result = @$link->query($sql)){
            header("Location: ../kanban/welcome.php?mess=success");
        }else{
            header("Location: ../kanban/welcome.php");
            echo "Blad podczas dodawania do tabeli: " .$link->errno;
        }
    }
}
$link->close();
$link = null;

?>