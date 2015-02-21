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
$programs = $_POST['programs'];  //Array of program_ids, only retrieves data from the change selection page

$programid = $programs[0]; //Only one nonprofit_id will exist since we use radio buttons on the change selection page
$program = '';


//echo $servicesid;


if ( $button == 'Add' ) {
    //Display the add title
    echo '<h2>Add a new program</h2>';
    echo '<form action="insertprograms.php" method="POST">';
    echo '<p> Program Name: <input type="text" name="program" value="' .
       $program . '"/></p>';

//Connect to the database and retrieve the services name
$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}

$sql = 'select * from programs';

if ( !$result ) {
    die( 'Services query failed. Error is: ' . mysqli_error($db) );
}
    $result = mysqli_query( $db, $sql );
$row = mysqli_fetch_array( $result);
$nonprofitname = $row['program_id'];
$nonprofitid = $row['program'];

while ( $row = mysqli_fetch_array( $result) ){
   echo $nonprofitname;
}


    while ( $row = mysqli_fetch_array( $result) ) {
       echo '<p><input type="radio" name="nonprofitnames[]" value="'.
           $nonprofitid. '"/>' .$nonprofitname. '</p>';

    }

    //Display the audience list

    $sql = 'select * from programs p, audience a where p.audience_id = a.audience_id';
    $result = mysqli_query( $db, $sql );
    if ( !$result ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }
    while ( $row = mysqli_fetch_array( $result) ) {
        echo '<p><input type="radio" name="audiences[]" value="'.
          $row['p.audience_id'] . '"/>' . $row['a.audience'];
      echo $row['a.audience'];
    }
    echo '<p> Program description: <input type="text" name="programdescription" value="' .
       $programdescription . '"/></p>';
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
    echo '<p>Name: <input type="text" name="nonprofitname" value="' .
        $nonprofitname . '"/></p>';
    echo '<p>Address: <input type="text" name="npaddress" value="' .
        $npaddress . '"/></p>';
    echo '<p>Email: <input type="email" name="npemail" value="' .
        $npemail . '"/></p>';
    echo '<p>Phone number: <input type="tel" name="npphonenumber" value="' .
        $npphonenumber . '"/></p>';
    echo '<p>Website: <input type="text" name="npwebsite" value="' .
        $npwebsite . '"/></p>';
    echo '<p>Non-profit description: <input type="text" name="npdescription" value="' .
        $npdescription . '"/></p>';

}



//Add the submit button
if ( $button == 'Add' ) {
    //Display the add title
    echo '<input type="submit" name="Button" value="Add Nonprofits"/>';
} else {
    echo '<input type="submit" name="Button" value="Change Nonprofits"/>';
}

echo '</form>';


