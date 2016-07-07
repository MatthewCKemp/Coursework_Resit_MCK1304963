<!doctype html>
<html lang=en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" type ="text/css" href="layout.css" />
</head>
<body>
<div id ="header">Search</div>
<div id="navigation">
    <ul>
        <p><strong>Links</strong></p>
        <li><a href="http://mck1304963cwresit.azurewebsites.net/Login.php">Login</a></li>
        <li><a href="http://mck1304963cwresit.azurewebsites.net/Register.php">Create a new account</a></li>
        <li><a href="http://mck1304963cwresit.azurewebsites.net/BugCreationForm.php">Create a new Bug</a></li>
        <li><a href="http://mck1304963cwresit.azurewebsites.net/Welcome.php">Return to the welcome page</a></li>
    </ul>
</div>
<div id="content">
    <div id="container">
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


            $keywords = "SELECT key_description FROM Keywords";

            echo "<option name=Keywords>Keyword</option>";
            foreach ($conn->query($keywords) as $row){
                echo "<option value=$row[key_description]></option>";
            }

            echo "</select>";
            mysqli_close($conn);
            ?>
    </div>
</div>
<div id="footer">
    <p><strong>Legal shit</strong></p>
</div>


</body>
</html>