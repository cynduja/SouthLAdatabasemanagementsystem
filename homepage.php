<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/11/14
 * Time: 12:06 AM
 */

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
    <title>South LA nonprofit database</title>
    <link href="styles.css" rel="stylesheet" type="text/css">
    <style>
        .gobacktosearchpage{top:200px; width:200px;}
    </style>
 
</head>
<body>
<div id = "hompagecontainer">
<h1> South LA non-profit database</h1>
<h2> Welcome, Administrator. Click on which section you want to make modifications to:</h2>
<a href = "services.php"><button type = "button" class = "frontbutton">Services</button></a>
<a href = "audience.php"><button type = "button" class = "frontbutton">Target groups</button></a>
<a href = "nonprofits.php"><button type = "button" class = "frontbutton">Non-profits database</button></a>
<a href = "programs.php"><button type = "button" class = "frontbutton"> Programs</button></a>
<a href = "mapping.php"><button type = "button" class = "frontbutton"> Mapping</button></a>
<a href = "logout.php"> <button type = "button" id = "logout"class = "frontbutton">Logout</button></a>
</div>

<div id = "hompagecontainer2">
    <h1>Your account: <h1>
        <h2>Here you can edit your profile, delete your profile or create a new profile for someone.</h2>
    <a href = "user.php"><button type = "button" class = "frontbutton">Access account</button></a>
    </div>
<a href = "index.php"><button class="gobacktosearchpage"> Go back to search page</button></a>

</body>
</html>
