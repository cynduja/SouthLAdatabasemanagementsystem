<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/9/14
 * Time: 7:03 PM
 */

session_start();

if ( !isset( $_SESSION['username'] ) ) {
    //User is not logged in. Send to login page
    require('prelogin.html');
    require('postlogin.html');
    exit();
}//User is logged in properly. Display next page.

$button = $_POST['Button'];
$services = $_POST['services'];  //Array of services_ids, only retrieves data from the change selection page

$servicesid = $services[0]; //Only one services_id will exist since we use radio buttons on the change selection page
$servicename = '';

//echo $servicesid;

echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';

if ( $button == 'Add' ) {
    //Display the add title
    echo '<h2>Add a new service category</h2>';
    echo '<form action="insertservices.php" method="POST">';
    echo '<h3>Name: <input type="text" name="name" value="' .
        $servicename . '"/></h3>';
}

else {
    //Display the change title
    echo '<h2>Change or update a service category</h2>';

    //Connect to the database and retrieve the services name
    $db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

    if ( mysqli_connect_errno() != 0 ) {
        //There was an error connecting to the database
        die("Error connecting to the database. The error is: " . mysqli_connect_error());
    }
    $sql = 'select * from services where services_id =' .$servicesid;

    $result = mysqli_query( $db, $sql );
    if ( !$result ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }

    $row = mysqli_fetch_array( $result );
    $servicename = $row['service'];
    $servicesid = $row ['services_id'];
    echo '<form action="updateservices.php" method="POST">';
    echo '<input type="hidden" name="services_id" value="' . $servicesid . '"/>';
    echo '<h3>Name: <input type="text" name="name" value="' .
        $servicename . '"/></h3>';
}



//Add the submit button
if ( $button == 'Add' ) {
    //Display the add title
    echo '<input type="submit" name="Button" class = "frontbutton" value="Add Services"/>';
} else {
    echo '<input type="submit" name="Button" class = "frontbutton" value="Change Services"/>';
}

echo '</form>';

echo'<a href = "services.php"><button class="gobacktosearchpage"> Go back to services page</button></a>';

echo'</body></html>';



