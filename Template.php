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

        $bugID = $_GET["bugID"];
        $Title = $_GET["title"];

        if (isset($_GET["bugID"])) {
            $_SESSION["bugID"] = $_GET["bugID"];
        }
        if (isset($_GET["title"])) {
            $_SESSION["title"] = $_GET["title"];
        }

        $UserID = mysqli_real_escape_string($conn, $_SESSION['login']);

        ?>
    </head>
    <body>
        <div id ="header"><?php echo$_SESSION["title"]; ?></div>
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
                $BugQuery = "SELECT Bugs.title, Bugs.description, Bugs.bugposted, Bugs.bugfixed, Users.name, Users.country FROM Bugs, Users WHERE Bugs.user_ID LIKE Users.user_ID AND Bugs.bug_ID LIKE $_SESSION[bugID] ";
                $BugResult = mysqli_query($conn, $BugQuery);

                if (mysqli_num_rows($BugResult) > 0 ){
                    while ($BugRows = mysqli_fetch_assoc($BugResult)) { 
                        echo "<br>" . "<strong>Title</strong>: " . $BugRows["title"] .  "<br>" . "<strong>Description:</strong> " . $BugRows["description"] . "<br>" . "<strong>Date posted:</strong> " . $BugRows["bugposted"] . "<br>" . "<strong>Date solved:</strong> " . $BugRows["bugfixed"]. "<br>" . "<strong>Developer's name: </strong>" . $BugRows["name"];
                        if(empty($BugRows["bugfixed"])) {
                            echo "<br>" . "Bug has not been solved";
                        }else{
                            echo "<br>" . "Bug has been solved";
                        }
                    }
                    echo"</table>";
                } else {
                    echo "An error has occurred. This bug does not exist." . mysqli_error($conn);
                }
                ?>
            </div>
        </div>
        <div id="comments">
            <div id="Com-container">
                <p><strong>Comments</strong></p>
                <?php
                $CommentQuery = "SELECT Comments.com_content, Users.name FROM Comments, Users, Bugs WHERE Comments.user_ID LIKE Users.user_ID AND Comments.bug_ID LIKE Bugs.bug_ID AND Bugs.bug_ID LIKE $_SESSION[bugID]";
                $CommentResult = mysqli_query($conn, $CommentQuery);
    
                if (mysqli_num_rows($CommentResult) > 0 ){
                    while ($CommentRows = mysqli_fetch_assoc($CommentResult)) { //Outputs data in each row.
                        echo "<br>" . "<strong>" .$CommentRows["name"] . "</strong>" . ": " . $CommentRows["com_content"];
                    }
                    echo"</table>";
                } else {
                    echo "There are currently no comments on this bug" . mysqli_error($conn);
                }
                ?>
                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <br><br><br><br><br>
                    Remember to use '@' to indicate who you are replying to:  <br>
                    Comment: <input type="text" name="CommentNew" required><br>
                    <input type="submit" value ="Comment"/><br/>
                </form>
               
                <?php
                $CommentCreated = mysqli_real_escape_string($conn, $_POST["CommentNew"]);
                $_SESSION["NewestComment"] = $CommentCreated;

                //echo "Comment: " . $_POST["CommentNew"] . "<br>"; //Debug variable displays
                //echo "U_ID: " . $UserID . "<br>";
                //echo "B_ID: " . $_SESSION['bugID'] . "<br>";
                echo "DollaS_Comment: " . $_SESSION['NewestComment'] . "<br>";

                if (!empty($CommentCreated)) {
                    $CommentInsert = "INSERT INTO Comments (com_content, user_ID, bug_ID) VALUES ('$CommentCreated', '$UserID', $_SESSION[bugID])";
                    if (mysqli_query($conn, $CommentInsert)) {
                        echo "<br>" . "Your comment has been created successfully. ";
                    } else {
                        echo "<br>" . "ERROR: You must login to comment. " . "<br>" . mysqli_error($conn);
                    }
                        
                }
                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type = "submit" name ="Delete" value="Delete">
                </form>
                <?php
                    if ($_SESSION['priv'] = "Developer"){;
                        if(isset($_POST['Delete'])){
                            $DELETE = "DELETE FROM Comments, WHERE com_content LIKE $_SESSION[NewestComment] LIMIT 1)";
                            echo "<br>" . "Comment deleted. ";
                        }else {
                            echo "<br>" . "button pressed";
                            echo "<br>" . "No comment to delete. " . mysqli_error($conn);
                        }
                    }else{
                        echo "<br>" . "You must be logged in to comment.";
                    }
                mysqli_close($conn);
                ?>
            </div>
        </div>
        <div id="footer">
            <p><strong>Website by Matthew.C.Kemp</strong></p>
        </div>
    </body>
</html>