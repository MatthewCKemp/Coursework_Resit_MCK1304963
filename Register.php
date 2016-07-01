<!doctype html>
<html lang=en">
<head>
    <meta charset="UTF-8">
    <title>BugSplat Registration</title>
</head>
<body>

<form action="Register.php" method="post">
    Please fill in the following details to create your account:<br>
    Name (This will become your username): <input type="text" name="U_name"><br>
    Home Country: <input type="text" name="U_country"><br>
    <input type="submit" value ="Submit "/><br/>
</form>

<?php
$username = "b56f549a76a983";
$password = "a3035583";
$servername = "us-cdbr-azure-west-c.cloudapp.net";

// Create connection to DB
$conn = mysqli_connect($servername, $username, $password);
$select = mysqli_select_db($conn, 'mck1304963_cwrs_db');
// Check the connectionas
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    //echo "Connected successfully";
    if (!$select) {
        die(" Selection failed: " . mysqli_connect_error());
    }
    //echo " DB Selected successfully";

    $UserName = mysqli_real_escape_string($conn, $_POST["U_name"]);
    $UserCountry = mysqli_real_escape_string($conn, $_POST["U_country"]);

    $UserInsert = "INSERT INTO Users (name, country) VALUES ('$UserName', '$UserCountry')";
        if(mysqli_query($conn, $UserInsert)){
            echo " Your account has been created successfully .";
            echo "Your password is: " . $UserCountry;
            
        } else {
            echo " ERROR: Unable to create account" . mysqli_error($conn);
        }
mysqli_close($conn);
?>
</body>
</html>