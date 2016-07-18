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
        <div id ="header"><!--Bug header--></div>
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
                $BugQuery = "SELECT title, description, bugposted, bugfixed, status, name, country FROM Bugs, Users WHERE Users.bug_ID = Bugs.bug_ID";
                $BugResult = mysqli_query($conn, $BugQuery);

                if (mysqli_num_rows($BugResult) > 0 ){
                    while ($BugRows = mysqli_fetch_assoc($BugResult)) { 
                        echo "<br>" . $BugRows["title"] . "<br>" . $BugRows["description"] . "<br>" . $Bugrows["bugposted"] . "<br>" . $Bugrows["bugfixed"]. "<br>" . $Bugrows["name"]. "<br>" . $Bugrows["country"];
                        $Status = "Bugs.status";
                    }
                    echo"</table>";
                } else {
                    echo "An error has occurred. This bug does not exist.";
                }
                if($Status = "NULL") {
                    echo "<br>" . "Bug has not been solved";
                }else{
                    echo "<br>" . "Bug has been solved";
                }
                
                ?>
            </div>
        </div>
        <div id="comments">
            <div id="container">
                <p><strong>Comments <!--RELEVANT COMMENTS--> </strong></p>
                <?php
                $CommentQuery = "SELECT com_content, name, bugposted FROM Comments, Users WHERE Comments.user_ID = Users.user_ID AND Comments.bug_ID = Bugs.bug_ID";
                $CommentResult = mysqli_query($conn, $CommentQuery);
    
                if (mysqli_num_rows($CommentResult) > 0 ){
                    while ($CommentRows = mysqli_fetch_assoc($CommentResult)) { //Outputs data in each row.
                        echo "<br>" . $CommentRows["name"] . "<br>" . $CommentRows["com_content"] . "<br>";
                    }
                    echo"</table>";
                } else {
                    echo "There are currently no comments on this bug";
                }
                ?>
                
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    Remember to use '@' to indicate who you are replying to: <br>
                    Comment): <input type="text" name="Comment_New" required><br>
                    <input type="submit" value ="Post"/><br/>
                </form>
               
                <?php
                
                $CommentCreated = mysqli_real_escape_string($conn, $_POST["Comment_New"]);
                $CommentInsert = "INSERT INTO Comments (com_content, bug_ID, user_ID,) VALUES ('$CommentInsert','$UserID','$BugID')";
                $UserID = mysqli_real_escape_string($conn,$_SESSION['login']);
                $BugID = mysqli_real_escape_string($conn,$_SESSION['Bug']);
                
                if(!empty($CommentCreated)AND !empty($UserID) AND !empty($BugID)) {
                    if (mysqli_query($conn, $UserInsert)) {
                        echo "<br>" . "Your comment has been created successfully .";
                    } else {
                        echo "<br>" . " ERROR: You must login to comment" . mysqli_error($conn);
                    }
                }
                mysqli_close($conn);
    
                ?>
            </div>
        </div>
        <div id="footer">
            <p><strong>Legal stuff</strong></p>
        </div>
    </body>
</html>