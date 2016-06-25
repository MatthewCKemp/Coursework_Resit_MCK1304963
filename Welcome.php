
<?php
$username = "b56f549a76a983";
$password = "a3035583";
$host = "us-cdbr-azure-west-c.cloudapp.net";
$connector = mysql_connect(us-cdbr-azure-west-c.cloudapp.net, b56f549a76a983, a3035583)
or die("Unable to connect");
?>

<!DOCTYPE html>
<html xmlns="http://mck1304963cwresit.azurewebsites.net/Welcome.php"/>
<head>
    <title>Welcome</title>
    <link href="style/index-layout.css" rel="stylesheet" type="text/css" />
    <link href="style/homepage-layout.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<!--right-->
<div id="body">
    <div id="left">
    </div></div>
<?php
//Search Database
$result = mysql_query("SELECT * FROM Users_brand");
?>
<table>
    <thead>
    <tr>
        <th>user_ID</th>
        <th>name</th>

    </tr>
    </thead>
    <tbody>
    <?php
    while ($row = mysql_fetch_assoc($result)) {
        echo
        "<tr>
          <td>{$row['user_ID']}</td>
          <td>{$row['name']}</td>
        </tr>";
    }
    ?>
    </tbody>
</table>
</body>
</html>
<?php mysql_close($connector); ?>

