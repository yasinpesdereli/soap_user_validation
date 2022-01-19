<?php 

session_start();
include_once "db.php";
if(isset($_SESSION["user_id"])){
    session_unset();
    session_destroy();
    header("location: login.php");
}

?>