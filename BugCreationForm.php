<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>BugSplat: Create a New Bug</title>
        <link rel="stylesheet" type ="text/css" href="layout.css" />
    </head>
        <body>
            <div id ="header">Create new Bug</div>
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
            
            ?>
            <div id="container">
                <form action="BugCreationForm.php" method="post">
                    Title of Bug: <input type="text" name="B_title"><br>
                    Description (50char max): <input type="text" name="B_Desc"><br>
                    Author name: <input type="text" name="B_Author"><br>
                    <input type="submit" value ="Submit">
                </form>
            </div>
            <?php echo "Title: " . $_POST["B_title"]; ?><br>
            <?php echo "Description: " .$_POST["B_Desc"]; ?><br>
            <?php echo "Author: " . $_POST["B_Author"]; ?><br>
            <?php echo "Date: " . Date ("Y-m-d");

            $BugTitle = mysqli_real_escape_string($conn, $_POST["B_title"]);
            $BugDesc = mysqli_real_escape_string($conn, $_POST["B_Desc"]);
            $BugAuthor = mysqli_real_escape_string($conn, $_POST["B_Author"]);
            $BugDate = mysqli_real_escape_string($conn, Date ("Y-m-d)"));

            $Insert = "INSERT INTO Bugs (title, description, bugposted) VALUES ('$BugTitle', '$BugDesc', '$BugDate')";
                if(mysqli_query($conn, $Insert)){
                    echo " Data successfully inserted.";
                } else {
                    echo " ERROR: Unable to insert data" . mysqli_error($conn);
                }
            mysqli_close($conn);
            ?>
        </body>
</html>
