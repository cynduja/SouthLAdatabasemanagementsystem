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

echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';
$button = $_POST['Button'];
$nonprofit = $_POST['nonprofits'];  //Array of np_ids, only retrieves data from the change selection page

$nonprofitid = $nonprofit[0]; //Only one nonprofit_id will exist since we use radio buttons on the change selection page
$nonprofitname = '';

//echo $servicesid;

if ( $button == 'Add' ) {
    //Display the add title
    echo '<h2>Add a new non-profit</h2>';
    echo '<form action="insertnonprofits.php" method="POST">';
    echo '<h3>Name: <input type="text" name="nonprofitname" value="' .
        $nonprofitname . '"/></h3>';
    echo '<h3>Address: <input type="text" name="npaddress" value="' .
        $npaddress . '"/></h3>';
    echo '<h3>Email: <input type="email" name="npemail" value="' .
        $npemail . '"/></h3>';
    echo '<h3>Phone number: <input type="tel" name="npphonenumber" value="' .
        $npphonenumber . '"/></h3>';
    echo '<h3>Website: <input type="text" name="npwebsite" value="' .
        $npwebsite . '"/></h3>';
    echo '<h3>Non-profit description: <input type="text" name="npdescription" value="' .
        $npdescription . '"/></h3>';
}

else {
    //Display the change title
    echo '<h2>Change or update a non-profit</h2>';

    //Connect to the database and retrieve the services name
    $db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

    if ( mysqli_connect_errno() != 0 ) {
        //There was an error connecting to the database
        die("Error connecting to the database. The error is: " . mysqli_connect_error());
    }
    $sql = 'select * from Main_nonprofits where np_id =' .$nonprofitid;

    $result = mysqli_query( $db, $sql );
    if ( !$result ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }

    $row = mysqli_fetch_array( $result );
    $nonprofitname = $row['name'];
    $nonprofitid = $row ['np_id'];
    $npaddress = $row ['address'];
    $npemail = $row['email'];
    $npphonenumber = $row['phone_number'];
    $npwebsite = $row['website'];
    $npdescription = $row['description'];


    echo '<form action="updatenonprofits.php" method="POST">';
    echo '<input type="hidden" name="nonprofitid" value="' . $nonprofitid . '"/>';
    echo '<h3>Name: <input type="text" name="nonprofitname" value="' .
        $nonprofitname . '"/></h3>';
    echo '<h3>Address: <input type="text" name="npaddress" value="' .
        $npaddress . '"/></h3>';
    echo '<h3>Email: <input type="email" name="npemail" value="' .
        $npemail . '"/></h3>';
    echo '<h3>Phone number: <input type="tel" name="npphonenumber" value="' .
        $npphonenumber . '"/></h3>';
    echo '<h3>Website: <input type="text" name="npwebsite" value="' .
        $npwebsite . '"/></h3>';
    echo '<h3>Non-profit description: <input type="text" name="npdescription" value="' .
        $npdescription . '"/></h3>';

}



//Add the submit button
if ( $button == 'Add' ) {
    //Display the add title
    echo '<p><input type="submit" name="Button" class ="frontbutton" value="Add Nonprofits"/></p>';
} else {
    echo '<p></p><input type="submit" name="Button" class = "frontbutton"value="Change Nonprofits"/></p>';
}

echo '</form>';

echo'<a href = "nonprofits.php"><button class="gobacktosearchpage"> Go back to non-profits page</button></a>';

echo'</body></html>';

