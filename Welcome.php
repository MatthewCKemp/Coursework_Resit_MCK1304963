
<?php
$username = "b56f549a76a983";
$password = "a3035583";
$servername = "us-cdbr-azure-west-c.cloudapp.net";

// Create connection to DB
$conn = mysqli_connect($servername, $username, $password);

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
