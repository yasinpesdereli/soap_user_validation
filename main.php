<?php
error_reporting(E_ERROR | E_PARSE);
session_start();

if (!isset($_SESSION["user_id"])) {
    header("location: login.php");
}

include "db.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>

<body>
    <div class="topnav">
        
        <ul>
            <li>
                <p class="pagename" href="main.php">Anasayfaya Hoşgeldiniz</p>
            </li>
            <li>
                <?php if($_SESSION["isadmin"]==1){
                    ?><a href="adminpage.php">Admin Page</a> <?php
                } ?>
            </li>
            <li>
                <a href="main.php">Main Page</a>
            </li>
            <li>
                <a href="logout.php">Logout</a>
            </li>
        </ul>

    </div>

</body>

</html>