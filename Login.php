<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>BugSplat Login</title>
        <link rel="stylesheet" type ="text/css" href="layout.css" />
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
        session_start();
        ?>
    </head>
        <body>
            <div id ="header">Login</div>
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
                <div id="container">
                    <form action="Login.php" method="post">
                        <label>Username: </label><input type="text" name="username"/><br><br/>
                        <label>Password: </label><input type="password" name="password"/><br><br/>
                        <input type="submit" value ="Login"/><br/>
                    </form>
                    <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST") {

                            $name = mysqli_real_escape_string($conn, $_POST['username']);
                            $Pass = mysqli_real_escape_string($conn, $_POST['password']);

                            $Search = "SELECT user_ID FROM Users WHERE name = '$name' AND country = '$Pass'";
                            $result = mysqli_query($conn, $Search);
                            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            $active = $row['active'];
                            $count = mysqli_num_rows($result);

                            if ($count == 1) {
                                $_SESSION['login'] = "$name";
                                echo "correct login";
                            } else {
                                $error = "Incorrect login, please retry";
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