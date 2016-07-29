<!doctype html>
<html lang=en">
<head>
    <meta charset="UTF-8">
    <title>BugSplat</title>
    <link rel="stylesheet" type ="text/css" href="layout.css" />
    <?php
    session_start();
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

    //Query based on user selection pulls all required data
    $devID = $_GET["devID"];
    $UserName = "SELECT name FROM users WHERE user_ID LIKE devID";
    $NameResult = mysqli_query($conn, $UserName);
    ?>
</head>
<body>
<div id ="header"><?php echo "User" . $NameResult?></div>
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
        <!--Bug info + creator and location-->
        <?php
        $UserQuery = "SELECT Users.name, Users.country, Bugs.title, Bugs.bugposted FROM Users, Bugs WHERE Bugs.user_ID LIKE Users.user_ID AND Users.user_ID LIKE $devID ";
        $UserResult = mysqli_query($conn, $UserQuery);
        
        if (mysqli_num_rows($UserResult) > 0 ){
            while ($UserRows = mysqli_fetch_assoc($UserResult)) {
                echo "<br>" . $UserRows["name"] . "<br>" . $UserRows["country"] . "<br>" . $UserRows["title"] . "<br>" . $UserRows["bugposted"];
            }
            echo"</table>";
        } else {
            echo "An error has occurred. This bug does not exist." . mysqli_error($conn);
        }
        mysqli_close($conn);
        ?>
    </div>
</div>
<div id="comments">
    <div id="container">
        <p><strong>Comments <!--RELEVANT COMMENTS--> </strong></p>
    </div>
</div>
<div id="footer">
    <p><strong>Legal stuff</strong></p>
</div>
</body>
</html>