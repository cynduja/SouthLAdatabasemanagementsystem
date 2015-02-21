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
    <title>Your account</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<h2> Welcome to your account</h2>
<form action="addchangeuser.php" method="post">
    <p><input type="submit" class = "frontbutton" name="Button" value="Create a new profile"/></p>
    <p><input type="submit" class = "frontbutton" name="Button" value="Edit/Update a profile"/></p>

</form>

<form action="deleteuser.php" method="post">
    <p><input type="submit" class = "frontbutton" name="Button" value="Delete your profile"/></p>

</form>
<a href = "homepage.php"><button class="gobacktosearchpage"> Go back to Adminlogin page</button></a>
</body>
</html>