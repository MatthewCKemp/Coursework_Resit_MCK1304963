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
                $_GET["bugID"];
                $BugQuery = "SELECT Bugs.title, Bugs.description, Bugs.bugposted, Bugs.bugfixed, Bugs.status, Users.name, Users.country FROM Bugs, Users WHERE Bugs.user_ID = Bugs.bug_ID AND Bugs.bug_ID = '$bugID' ";
                $BugResult = mysqli_query($conn, $BugQuery);

                if (mysqli_num_rows($BugResult) > 0 ){
                    while ($BugRows = mysqli_fetch_assoc($BugResult)) { 
                        echo "<br>" . $BugRows["title"] . "<br>" . $BugRows["description"] . "<br>" . $BugRows["bugposted"] . "<br>" . $BugRows["bugfixed"]. "<br>" . $BugRows["name"]. "<br>" . $BugRows["country"];
                        $Status = "Bugs.status";
                    }
                    echo"</table>";
                } else {
                    echo "An error has occurred. This bug does not exist." . mysqli_error($conn);
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
                $CommentQuery = "SELECT Comments.com_content, Users.name FROM Comments, Users WHERE Comments.user_ID = Users.user_ID AND Comments.bug_ID = Bugs.bug_ID AND Bugs.bug_ID = '$bugID'";
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
                $UserID = mysqli_real_escape_string($conn,$_SESSION['login']);
                $BugID = 10; //mysqli_real_escape_string($conn,$_SESSION['Bug']);
                
                $CommentInsert = "INSERT INTO Comments (com_content, user_ID, bug_ID) VALUES ('$CommentCreated', '$UserID', '$BugID')";
                
                if(!empty($CommentCreated)AND !empty($UserID) AND !empty($BugID)) {
                    if (mysqli_query($conn, $CommentInsert)) {
                        echo "<br>" . "Your comment has been created successfully .";
                    } else {
                        echo "<br>" . "ERROR: You must login to comment " . "<br>" . mysqli_error($conn);
                    }
                }
                $NewestComment = "SELECT com_content FROM Comments WHERE user_ID = $UserID ORDER BY com_ID DESC, LIMIT 1";
                ?>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <input type = "hidden" name="DeleteComment" value"">
                    <input type = "submit" name ="submit" value="Delete">
                </form>
                <?php
                    if(isset($POST['DeleteComment'])){
                        $DELETE = "DELETE FROM Comments WHERE com_content = $NewestComment";
                        echo "<br>" . "Comment deleted. ";
                    }else{
                        echo "<br>" . "No comment to delete. ";
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