<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>BugSplat Login</title>
        <link rel="stylesheet" type ="text/css" href="layout.css" />
    </head>
    <body>
        <div id="login">
            <div id ="header">Login</div>
            <form action="Login.php" method="post">
                Username: <input type="text" name="username"><br>
                Password: <input type="password" name="password"><br>
                <input type="submit" value ="Submit "/><br/>
            </form>
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

            $Search = "SELECT * FROM Users WHERE name = '$name' AND country = '$Pass'";
            $result = mysqli_query($conn,$search);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $active = $row['active'];

            $count = mysqli_num_rows($result);

            if($count == 1) {
                $_SESSION['login_user'] = 'username';
                echo "correct login";
                header("location: Welcome.php");
            
            }else {
                $error = "Incorrect login";
                echo $error . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
        ?>
    </body>
</html>