<?php 

session_start();
include "db.php";

if (!($_SESSION["isadmin"] == 1)) {
    header("location: main.php");
}

$user_id = $_GET["id"];


$sql = mysqli_query($conn, "DELETE FROM user_info WHERE user_id = '$user_id'");

if($sql){
    mysqli_close($conn);
    header("location: adminpage.php");
    exit;
}else{
    echo "Something went wrong";
}
?>