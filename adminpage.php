<?php
session_start();
include_once "db.php";

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
    <title>Admin Page</title>
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
                    <a class="active" href="">
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

            <table class="data-table">
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Password</th>
                    <th>TC No</th>
                    <th>Is Admin</th>

                </tr>

                <?php
                $query = "SELECT * FROM user_info";
                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td> <?php echo $row["user_id"] ?></td>
                        <td> <?php echo $row["name"] ?></td>
                        <td> <?php echo $row["surname"] ?></td>
                        <td> <?php echo $row["password"] ?></td>
                        <td> <?php echo $row["tc_no"] ?></td>
                        <td> <?php echo $row["isadmin"] ?></td>
                        <td class="functions">
                            <a href="edit.php?id=<?php echo $row['user_id'] ?>"><button class="edit-btn">Edit</button></a><br>
                            <a href="delete.php?id=<?php echo $row['user_id'] ?>"><button class="remove-btn">Delete</button></a>
                        </td>
                    </tr>
                <?php
                }

                ?>
            </table>
        </div>




    </div>
    <div class="footer">
        <p>By ViktorDOom</p>
    </div>

</body>

</html>

<?php







?>