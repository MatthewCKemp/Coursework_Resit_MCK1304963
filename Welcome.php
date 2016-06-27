<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome to Bugsplat</title>
    </head>
        <body>
            <?php
            $username = "b56f549a76a983";
            $password = "a3035583";
            $servername = "us-cdbr-azure-west-c.cloudapp.net";

            // Create connection to DB
            $conn = mysqli_connect($servername, $username, $password);
            $select = mysqli_select_db("mck1304963_cwrs_db");
            // Check the connection
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            echo "Connected successfully";
            if (!$select) {
                die("Selection failed: " . mysqli_connect_error());
            }
            echo "DB Selected successfully";
            ?>
        </body>
</html>