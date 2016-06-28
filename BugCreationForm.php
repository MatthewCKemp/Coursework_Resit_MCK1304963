<!doctype html>
<html lang=en">
    <head>
        <meta charset="UTF-8">
        <title>BugSplat: Create a New Bug</title>
    </head>
        <body>
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
            mysqli_close($conn);
            ?>

            <form action="BugCreationForm.php" method="post">
                Title of Bug: <input type="text" name="B_title"><br>
                Description (50char max): <input type="text" name="B_Desc"><br>
                Author name: <input type="text" name="B_Author"><br>
                <input type="submit">
            </form>

            <?php echo $_POST["B_title"]; ?><br>
            <?php echo $_POST["B_Desc"]; ?><br>
            <?php echo $_POST["B_Author"]; ?><br>
            <?php echo date("d-m-Y");?>
        </body>
</html>
