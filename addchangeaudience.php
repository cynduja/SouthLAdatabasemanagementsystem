<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/10/14
 * Time: 9:53 PM
 */

session_start();

if ( !isset( $_SESSION['username'] ) ) {
    //User is not logged in. Send to login page
    require('prelogin.html');
    require('postlogin.html');
    exit();
}//User is logged in properly. Display next page.

$button = $_POST['Button'];
$audience = $_POST['audience'];  //Array of services_ids, only retrieves data from the change selection page

$audienceid = $audience[0]; //Only one services_id will exist since we use radio buttons on the change selection page
$audiencename = '';

//echo $servicesid;

echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';

if ( $button == 'Add' ) {
    //Display the add title
    echo '<h1>Add a new target group</h2>';
    echo '<form action="insertaudience.php" method="POST">';
    echo '<h2>Name: <input type="text" name="name" value="' .
        $audienceename . '"/></h2>';
}

else {
    //Display the change title
    echo '<h2>Change or update an audience category</h2>';

    //Connect to the database and retrieve the model name
    $db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

    if ( mysqli_connect_errno() != 0 ) {
        //There was an error connecting to the database
        die("Error connecting to the database. The error is: " . mysqli_connect_error());
    }
    $sql = 'select * from audience where audience_id =' .$audienceid;

    $result = mysqli_query( $db, $sql );
    if ( !$result ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }

    $row = mysqli_fetch_array( $result );
    $audienceename = $row['audience'];
    $audienceid = $row ['audience_id'];
    echo '<form action="updateaudience.php" method="POST">';
    echo '<input type="hidden" name="audience_id" value="' . $audienceid . '"/>';
    echo '<h2>Name: <input type="text" name="name" value="' .
        $audiencename . '"/></h2>';
}



//Add the submit button
if ( $button == 'Add' ) {
    //Display the add title
    echo '<input type="submit" name="Button" class = "frontbutton" value="Add Audience"/>';
} else {
    echo '<input type="submit" name="Button" class = "frontbutton" value="Change Audience"/>';
}

echo '</form>';
echo'<a href = "audience.php"><button class="gobacktosearchpage"> Go back to audience page</button></a>';

echo'</body></html>';


