<?php

session_start();
include "db.php";
if (!($_SESSION["isadmin"] == 1)) {
    header("location: main.php");
}

$user_id = $_GET["id"];

$sql = mysqli_query($conn, "SELECT * FROM user_info WHERE user_id = '$user_id'");

$row = mysqli_fetch_array($sql);
$tc = $row["tc_no"];
$birth_year = $row["birthyear"];
if (isset($_POST["update_user"])) {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $isadmin = $_POST["isadmin"];
    $password = $_POST["password"];

    $edit = mysqli_query($conn, "UPDATE user_info set name='$name', surname='$surname', tc_no = '$tc', birthyear='$birth_year',isadmin='$isadmin', password='$password' WHERE user_id='$user_id'");

    if ($edit) {
        mysqli_close($conn);
        header("location: adminpage.php");
        exit;
    } else {
        echo "Something went wrong";
    }
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
                    <a class="active" href="adminpage.php">
                        <p>Edit/Remove User</p>
                    </a>
                </li>
                <li>
                    <a href="add.php">
                        <p>Add User</p>
                    </a>
                </li>
            </ul>
        </div>

    </div>


    <div class="main-area">
        <div class="info-area">
            <h3>Update User: <?php echo $row["name"] ?></h3>
            <form class="edit-user" method="POST">
                <p>New Name <input type="text" name="name" value="<?php echo $row['name'] ?>" placeholder="Enter New Name"></p>
                <p>New Surname <input type="text" name="surname" value="<?php echo $row['surname'] ?>" placeholder="Enter New Surname"></p>
                <p>Is Admin <input type="text" name="isadmin" value="<?php echo $row['isadmin'] ?>" placeholder="For admin priviliges make it 1"></p>
                <p>New Password <input type="text" name="password" value="<?php echo $row['password'] ?>" placeholder="Enter New Password"></p>
                <input class="finish-edit" style="width: 150px;" class="finish-update" type="submit" name="update_user" value="Update User <?php echo $row["name"] ?>">
            </form>

        </div>
    </div>
    <div class="footer">
        <p>By ViktorDOom</p>
    </div>

</body>

</html>