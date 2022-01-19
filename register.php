<?php 
/*
session_start();
include_once "db.php";
if(isset($_SESSION["user_id"])){
    header("location: main.php");
}
*/
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
<div class="header">
        <h1>SOAP USER VALIDATION APP</h1>
    </div>
    <div class="logreg-form">
        
            <form action="" method="POST">
                <p>TC Number <input type="text" required="" name="tc" maxlength="11" placeholder="TC Identity Number"><br></p>
                <p>Name <br><input type="text" required="" name="name" placeholder="Name"></p>
                <p>Surname <input type="text" required="" name="surname" placeholder="Surname"><br></p>
                <p>Birthyear <input type="text" required="" name="birth_year" maxlength="4" placeholder="Year of Birth"><br></p>
                <p>Password <input type="text" required="" name="password"  placeholder="Password"><br></p>
                <button type="submit" name="submit-form">Register</button>
            </form>
            <h4 style="margin-left:65px ;">OR</h4>
       <a href="login.php"><button style="margin-top: -20px;">Login Here</button></a>
        
    </div>

</body>

</html>

<?php

function karakterDuzelt($yazi){
    $ara=array("ç","i","ı","ğ","ö","ş","ü");
    $degistir=array("Ç","İ","I","Ğ","Ö","Ş","Ü");
    $yazi=str_replace($ara,$degistir,$yazi);
    $yazi=strtoupper($yazi);
    return $yazi;
}
        
//header("location: main.php")

if (isset($_POST["submit-form"])) {

    $tc = $_POST["tc"];
    //$name = $_POST["name"];
    //$surname = $_POST["surname"];
    $birth_year = $_POST["birth_year"]; // username, pwd
    $password = $_POST["password"];

    $soap_conn = new SoapClient("https://tckimlik.nvi.gov.tr/Service/KPSPublic.asmx?WSDL");

    $name = karakterDuzelt(trim($_POST["name"]));
    $surname= karakterDuzelt(trim($_POST['surname']));

    
    $result = $soap_conn -> TCKimlikNoDogrula (['TCKimlikNo' => $tc,'Ad' => $name,'Soyad' => $surname,'DogumYili' => $birth_year]);

    
    if($result -> TCKimlikNoDogrulaResult){
        $sql = mysqli_query($conn, "INSERT INTO user_info(name, surname, tc_no, birthyear, password, isadmin) VALUES ('{$name}','{$surname}','{$tc}', {$birth_year},'{$password}', 0)");
        header("location: login.php");
        
    }else{
        echo "TC'de kaydınız yoktur";
    }
    


}else{
    header("location : register.php");
    exit();
}

    


?>

