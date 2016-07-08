<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>BugSplat Login</title>
        <link rel="stylesheet" type ="text/css" href="layout.css" />
    </head>
    <body>
    <div id ="header">Login</div>
    <div id="login">
        <form action="Login.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="password" name="password"><br>
            <input type="submit" value ="Login"/><br/>
        </form>
    </div>
    <div id="navigation">
        <ul>
            <p><strong>Links</strong></p>
            <li><a href="http://mck1304963cwresit.azurewebsites.net/Welcome.php">Return to the welcome page</a></li>
            <li><a href="http://mck1304963cwresit.azurewebsites.net/Register.php">Create a new account</a></li>
            <li><a href="http://mck1304963cwresit.azurewebsites.net/BugCreationForm.php">Create a new Bug</a></li>
            <li><a href="http://mck1304963cwresit.azurewebsites.net/Search.php">Search</a></li>
        </ul>
    </div>
    <div id="content">
        <p><strong>Main writing</strong></p>
    </div>
    <div id="comments">
        <p><strong>Comments</strong></p>
    </div>
    <div id="footer">
        <p><strong>Legal shit</strong></p>
    </div>
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

        if("POST") { //More secure than GET
                
            $name = mysqli_real_escape_string($conn,$_POST['username']);
            $Pass = mysqli_real_escape_string($conn,$_POST['password']);

            $Search = "SELECT user_ID, name FROM Users WHERE name = '$name' AND user_ID = '$Pass'";
            $result = mysqli_query($conn,$search);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $active = $row['active'];

            $count = mysqli_num_rows($result);
            echo $result;
            if($count == 1) {
                $_SESSION['login_user'] = 'username';
                echo "correct login";
                header("location: Welcome.php");
            
            }else {
                $error = "<Incorrect login";
                echo $error . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
        ?>
    </body>
</html>