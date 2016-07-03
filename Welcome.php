<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome to Bugsplat</title>
    </head>
        <body>
            <div id ="header">Welcome</div>
            <div id="navigation">
                <p><strong>Links</strong></p>
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

            //SQL query
            $query = "SELECT bug_ID, title, bugposted FROM Bugs ORDER BY bug_ID DESC";
            $result = mysqli_query($conn, $query);
            
            if (mysqli_num_rows($result) > 0) {  //breaks result into different rows for each one.
                while ($rows = mysqli_fetch_assoc($result)) {
                    echo "Bug: " . $rows["title"] . " Posted: " . $rows["bugposted"] . "<br>";
                }
            } else {
                echo "no results found";
            }
            mysqli_close($conn);
            ?>
        </body>
</html>