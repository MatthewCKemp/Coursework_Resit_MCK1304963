<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>BugSplat: Create a New Bug</title>
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
        ?>
    </head>
        <body>
            <div id ="header">Create A New Bug</div>
            <div id="navigation">
                <ul>
                    <p><strong>Links</strong></p>
                    <li><a href="http://mck1304963cwresit.azurewebsites.net/Welcome.php">Return to the welcome page</a></li>
                    <li><a href="http://mck1304963cwresit.azurewebsites.net/Login.php">Login</a></li>
                    <li><a href="http://mck1304963cwresit.azurewebsites.net/Register.php">Create a new account</a></li>
                    <li><a href="http://mck1304963cwresit.azurewebsites.net/Search.php">Search</a></li>
                </ul>
            </div>
            <div id="content">
                <div id="container">
                    <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">>
                        Title of Bug: <input type="text" name="B_title"><br>
                        Description (200char max): <textarea name="B_Desc" rows="5" cols = "40"><br>
                        Author name: <input type="text" name="B_Author"><br>
                        <input type="submit" value ="Create">
                    </form>
                    
                    <?php echo "Title: " . $_POST["B_title"]; ?><br>
                    <?php echo "Description: " .$_POST["B_Desc"]; ?><br>
                    <?php echo "Author: " . $_POST["B_Author"]; ?><br>
                    <?php echo "Date: " . date ("Y-m-d");

                    $BugTitle = mysqli_real_escape_string($conn, $_POST["B_title"]);
                    $BugDesc = mysqli_real_escape_string($conn, $_POST["B_Desc"]);
                    $BugAuthor = mysqli_real_escape_string($conn, $_POST["B_Author"]);
                    $BugDate = mysqli_real_escape_string($conn, date ("Y-m-d)"));

                    $Insert = "INSERT INTO Bugs (title, description, bugposted) VALUES ('$BugTitle', '$BugDesc', '$BugDate')";
                    if(mysqli_query($conn, $Insert)){
                        echo " Data successfully inserted.";
                    } else {
                        echo " ERROR: Unable to insert data" . mysqli_error($conn);
                    }
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
            <div id="comments">
                <div id="container">
                    <p><strong>Comments</strong></p>
                </div>
            <div id="footer">
                <p><strong>Legal stuff</strong></p>
            </div>
        </body>
</html>
