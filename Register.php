<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>BugSplat Registration</title>
        <link rel="stylesheet" type ="text/css" href="layout.css" />
        <?php
        session_start();
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
        ?>
    </head>
    <body>
        <div id ="header">Register</div>
        <div id="navigation">
            <ul>
                <p><strong>Links</strong></p>
                <li><a href="http://mck1304963cwresit.azurewebsites.net/Welcome.php">Return to the welcome page</a></li>
                <li><a href="http://mck1304963cwresit.azurewebsites.net/Login.php">Login</a></li>
                <li><a href="http://mck1304963cwresit.azurewebsites.net/BugCreationForm.php">Create a new Bug</a></li>
                <li><a href="http://mck1304963cwresit.azurewebsites.net/Search.php">Search</a></li>
            </ul>
        </div>
        <div id="content">
            <div id = "container">
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    Please fill in the following details to create your account:<br>
                    Name (This will become your username): <input type="text" name="U_name" required><br>
                    Home Country: <input type="text" name="U_country" required><br>
                    Set Password <input type = "password" name="U_password" required><br>
                    <input type="submit" value ="Register"/><br/>
                </form>
                <?php
                $UserName = mysqli_real_escape_string($conn, $_POST["U_name"]);
                $UserCountry = mysqli_real_escape_string($conn, $_POST["U_country"]);
                $UserPassword = mysqli_real_escape_string($conn, $_POST["U_password"]);
                
                $UserInsert = "INSERT INTO Users (name, country, password ) VALUES ('$UserName', '$UserCountry', '$UserPassword')";
                if(!empty($UserName)AND !empty($UserCountry) AND !empty($UserPassword)) {
                    if (mysqli_query($conn, $UserInsert)) {
                        echo " Your account has been created successfully .";
                    } else {
                        echo " ERROR: Unable to create account " . mysqli_error($conn);
                    }
                }
                mysqli_close($conn);
                ?>
            </div>
        </div>
        <div id="comments">
            <p><strong>Comments</strong></p>
        </div>
        <div id="footer">
            <p><strong>Legal stuff</strong></p>
        </div>
    </body>
</html>