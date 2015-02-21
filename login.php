<?php
//This script handles no username and password as a first access – no error.
//If either username or password are missing, Redisplay the login page, with an error message.
//If both username and password exist, we check them against the database.
//If the login is wrong, we display the login page with an error message.
//If both username and password are correct, we display model.html.

session_start();

$un = $_POST['username'];
$pw = $_POST['password'];
$errormsg = '';

if ( empty( $un ) && empty( $pw ) ) {
//Assume first access

    require('prelogin.html');
require('postlogin.html');
exit();
}

if ( empty( $un ) || empty( $pw ) ) {
    require('prelogin.html');
echo 'Invalid login';
require('postlogin.html');
exit();
}

//Have both a username and a password. Check against the database.
$sql = 'select * from user where username="'.$un.'" and password = "'. $pw .'"';

$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
//There was an error connecting to the database
die("Error connecting to the database. The error is:" .mysqli_connect_error());
}

$results = mysqli_query( $db, $sql );
if ( !$results ) {
die( 'Query failed. Error is:' .mysqli_error($db) );
}

if ( mysqli_num_rows( $results ) == 0 ) {
//Username and password were invalid
    require('prelogin.html');
echo 'Invalid login';
require('postlogin.html');
exit();
}

//Username and password are correct. Save userid to session. Display services.html
$row = mysqli_fetch_array( $results );
$username = $row['username'];
$_SESSION['username'] = $username;

require('homepage.php');
?>