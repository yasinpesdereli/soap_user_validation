<?php 

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dbName = "user_validate";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dbName);

if (!$conn) {
    echo("asdasd");
    die("connection failed".mysqli_connect_error());
}
?>