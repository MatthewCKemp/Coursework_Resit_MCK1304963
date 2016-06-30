<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>BugSplat Login</title>
    </head>
    <body>

        <form action="Login.php" method="post">
            Username: <input type="text" name="username"><br>
            Password: <input type="number" name="password"><br>
            <input type="submit" value ="Submit">
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
            
        if($_SERVER["REQUEST_METHOD"] == "POST") {
                
            $name = mysqli_real_escape_string($conn,$_POST['username']);
            $ID = mysqli_real_escape_string($conn,$_POST['password']);

            $Search = "SELECT user_ID FROM Users WHERE name = '$name' and user_ID = '$ID'";
            $result = mysqli_query($conn,$search);
            $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
            $active = $row['active'];

            $count = mysqli_num_rows($result);

            if($count == 1) {
                session_register("username");
                $_SESSION['login_user'] = $name;
    
                header("location: Welcome.php");
            }else {
                $error = "Incorrect login";
            }
        }
        mysqli_close($conn);
        ?>
    </body>
</html>