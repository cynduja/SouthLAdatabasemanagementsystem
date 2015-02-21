<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/11/14
 * Time: 12:11 AM
 */

    session_start();

    if ( !isset( $_SESSION['username'] ) ) {
        //User is not logged in. Send to login page
        require('prelogin.html');
        require('postlogin.html');
        exit();
    }

    //User is logged in properly. Display next page.
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">

    <title>Modify audience</title>
    <link href="styles.css" rel="stylesheet" type="text/css">

</head>
<body>
<form action="addchangeaudience.php" method="post">
    <p><input type="submit" name="Button" class = "frontbutton" value="Add"/></p>
</form>
<form action="selectaudience.php" method="post">
    <p><input type="submit" name="Button" class = "frontbutton" value="Change"/></p>
    <p><input type="submit" name="Button" class = "frontbutton" value="Delete"/></p>
</form>
<a href = "homepage.php"><button class="gobacktosearchpage"> Go back to Adminlogin page</button></a>

</body>
</html>