<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/13/14
 * Time: 9:19 PM
 */

session_start();

if ( !isset( $_SESSION['username'] ) ) {
//User is not logged in. Send to login page
    require('prelogin.html');
    require('postlogin.html');
    exit();
}//User is logged in properly. Display next page.


session_destroy();

echo'
<html>
<head>
<title>Logout</title>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>
<body><h2>Logged out successfully.</h2></body></html>';
require('prelogin.html');
require('postlogin.html');
exit();
?>