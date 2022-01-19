<?php

session_start();
include "db.php";
if (!($_SESSION["isadmin"] == 1)) {
    header("location: main.php");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>

<body>
    <div class="topnav2">

        <ul>
            <li>
                <a href="logout.php">Logout</a>
            </li>
            <li>
                <a href="main.php">Main Page</a>
            </li>
        </ul>

        <div class="sidebar">
            <ul class="sidebar-items">
                <li>
                    <h3 class="pagename" style="font-weight: bold;">Admin Page</h3>
                </li>
                <li>
                    <a href="adminpage.php">
                        <p>Edit/Remove User</p>
                    </a>
                </li>
                <li>
                    <a class="active" href="#">
                        <p>Add User</p>
                    </a>
                </li>
            </ul>
        </div>

    </div>

    <div class="main-area">
        <div class="info-area">
            <h3>Add User to Database</h3>
            <form class="add-user" action="" method="POST">

                <p>Name <input type="text" name="name" placeholder="Name"></p>
                <p>Surname <input type="text" name="surname" placeholder="Surname"></p>
                <p>TC <input type="text" name="tc" placeholder="TC Number" maxlength="11"></p>
                <p>Birthyear <input type="text" name="birthyear" placeholder="Birth Year"></p>
                <p>Password <input type="text" name="password" placeholder="Password"></p>
                <p>Is Admin <input type="text" name="isadmin" placeholder="Is Admin"></p>
                <input style="width: 150px;" type="submit" name="submit">

            </form>

        </div>
    </div>
    <div class="footer">
        <p>By ViktorDOom</p>
    </div>

</body>

</html>

<?php

function karakterDuzelt($yazi)
{
    $ara = array("ç", "i", "ı", "ğ", "ö", "ş", "ü");
    $degistir = array("Ç", "İ", "I", "Ğ", "Ö", "Ş", "Ü");
    $yazi = str_replace($ara, $degistir, $yazi);
    $yazi = strtoupper($yazi);
    return $yazi;
}

if (isset($_POST["submit"])) {
    $name = karakterDuzelt(trim($_POST["name"]));
    $surname = karakterDuzelt(trim($_POST['surname']));
    $tc = $_POST["tc"];
    $birth_year = $_POST["birthyear"]; // username, pwd
    $password = $_POST["password"];
    $isadmin = $_POST["isadmin"];

    $sql = mysqli_query($conn, "INSERT INTO user_info(name, surname, tc_no, birthyear, password, isadmin) VALUES ('{$name}','{$surname}','{$tc}', {$birth_year},'{$password}', {$isadmin})");
    if ($sql) {
        header("location: adminpage.php");
        exit;
    } else {
        echo "Went wrong";
    }
}



?>