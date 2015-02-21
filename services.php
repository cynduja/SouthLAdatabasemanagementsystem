<?php

session_start();

if ( !isset( $_SESSION['username'] ) ) {
    //User is not logged in. Send to login page
    require('prelogin.html');
    require('postlogin.html');
    exit();
}//User is logged in properly. Display next page.
?>
        
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Services page</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<form action="addchangeservices.php" method="post">
    <h2><input type="submit" name="Button" class = "frontbutton"value="Add"/></h2>
</form>
<form action="selectservices.php" method="post">
    <h2><input type="submit" name="Button" class = "frontbutton"value="Change"/></h2>
    <h2><input type="submit" name="Button" class = "frontbutton" value="Delete"/></h2>
</form>
<a href = "homepage.php"><button class="gobacktosearchpage"> Go back to Adminlogin page</button></a>
</body>
</html>