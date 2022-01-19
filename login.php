<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include_once "db.php";
if (isset($_SESSION["user_id"])) {
    header("location: main.php");
}

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
    <div class="header">
        <h1>SOAP USER VALIDATION APP</h1>
    </div>
    <div class="logreg-form">
        <form action="login.php" method="POST">
            <p>TC Number <input type="text" required="" name="tc" maxlength="11" placeholder="TC Identity Number"><br></p>
            
            <p>Password <input type="text" required="" name="password" placeholder="Password"><br></p>
           
            <button type="submit" name="submit-form">Login</button>
        </form>

       <h4 style="margin-left:65px ;">OR</h4>
       <a href="register.php"><button style="margin-top: -20px;">Register Here</button></a>
    </div>

    

</body>

</html>

<?php

$tc = $_POST["tc"];
$password = $_POST["password"];

$sql = mysqli_query($conn, "SELECT * FROM user_info WHERE (tc_no = '{$tc}') AND (password = '{$password}')");
if (isset($_POST["submit-form"])) {
    if (mysqli_num_rows($sql) > 0) {
        $row = mysqli_fetch_assoc($sql);

        $_SESSION["user_id"] =  $row["user_id"];
        if ($row["isadmin"] == 1) {
            $_SESSION["isadmin"] = $row["isadmin"];
            header("location: main.php");
        }
        header("location: main.php");
    } else {
        echo "Login Unsuccessful";
    }
}    
?> 