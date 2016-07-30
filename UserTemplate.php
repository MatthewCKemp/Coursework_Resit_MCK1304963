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
    ?>
</head>
<body>
<div id ="header"><?php echo "User: " . $_GET["name"]?></div>
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
        <?php
        $devID = $_GET["devID"];
        $UserQuery = "SELECT name, country FROM Users WHERE Users.user_ID LIKE $devID ";
        $ContentQuery = "SELECT Bugs.title, Bugs.bugposted FROM Users, Bugs WHERE Users.user_ID LIKE Bugs.user_ID AND Users.user_ID LIKE $devID ";
        $UserResult = mysqli_query($conn, $UserQuery);
        $ContentResult = mysqli_query($conn, $ContentQuery);
        
        if (mysqli_num_rows($UserResult) > 0 ){
            while ($UserRows = mysqli_fetch_assoc($UserResult)) {
                echo "<br>" . "<strong>Developer's name: </strong>" . $UserRows["name"] . "<br>" ."<strong>Home country: </strong>" . $UserRows["country"];
            }
            echo"</table>";
        } else {
            echo "An error has occurred. This user does not exist." . mysqli_error($conn);
        }
        if (mysqli_num_rows($ContentResult) > 0 ){
            echo "<strong>Developer's contributions: </strong><br>";
            while ($ContentRows = mysqli_fetch_assoc($ContentResult)) {
                echo "<br>" . $ContentRows["title"] . "<br>" . $ContentRows["bugposted"];
            }
            echo"</table>";
        } else {
            echo "An error has occurred. This user does not have any contributions." . mysqli_error($conn);
        }
        mysqli_close($conn);
        ?>
    </div>
</div>
<div id="comments">
    <div id="container">
        <p><strong></strong></p>
    </div>
</div>
<div id="footer">
    <p><strong>Website by Matthew.C.Kemp</strong></p>
</div>
</body>
</html>