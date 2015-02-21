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

if ( $button == 'Create a new profile' ) {
    //Display the add title
    echo '<h2>Create a new user profile</h2>';
    echo '<form action="insertuser.php" method="POST">';
    echo '<h3> <b>Enter Username: <input type="text" name="username" value="' .
       $username . '"/></b></h3>';

    echo '<h3> <b>Enter Password: <input type="password" name="password" value="' .
        $password . '"/></b></h3>';
//Connect to the database and retrieve the services name
$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}
$sql = 'select * from Main_nonprofits';

    $result = mysqli_query( $db, $sql );

if ( !$result ) {
    die( 'Services query failed. Error is: ' . mysqli_error($db) );
}

    echo '<h3><b> Pick a non-profit that the program belongs to</p></h3>';


    while ( $row = mysqli_fetch_array( $result) ) {
     echo '<h3><input type="radio" name="nonprofitids[]" value="'.
           $row['np_id']. '"/>' .$row['name']. '</h3>';

    }
}

//CHANGE/UPDATE CODE:

else {
    //Display the change title
    echo '<h2>Edit/Update or Delete your profile</h2>';

    //Connect to the database and retrieve the services name
    $db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

    if ( mysqli_connect_errno() != 0 ) {
        //There was an error connecting to the database
        die("Error connecting to the database. The error is: " . mysqli_connect_error());
    }
    $sql = 'select * from user where username ="' .$_SESSION['username'].'"';

    $result = mysqli_query( $db, $sql );
    if ( !$result ) {
        die( 'This query failed. Error is: ' . mysqli_error($db) );
    }

    $row = mysqli_fetch_array( $result );
    $username = $row['username'];
    $password = $row ['password'];
    $userid = $row['user_id'];
    $np_id = $row['np_id'];

    echo '<form action="updateuser.php" method="POST">';
    echo'<h3>You cannot change your username. Feel free to change other details</h3>';
    echo '<input type="hidden" name="userid" value="' . $userid . '"/>';
    echo '<h3>Password: <input type="password" name="password" value="' .
        $password . '"/></h3>';


    echo'<h2>Update the non-profit you belong to</h2>';

    $db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

    if ( mysqli_connect_errno() != 0 ) {
        //There was an error connecting to the database
        die("Error connecting to the database. The error is: " . mysqli_connect_error());
    }
    $sqlnonprofitname = 'select * from user u, Main_nonprofits m where m.np_id = u.np_id and u.np_id='.$np_id;
    $result1 = mysqli_query( $db, $sqlnonprofitname );



    if ( !$result1 ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }

    $row1 = mysqli_fetch_array($result1);

    $sql = 'select * from Main_nonprofits';

    $result = mysqli_query( $db, $sql );

    if ( !$result ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }

    //echo '<h2><b> Pick a non-profit that the program belongs to: Originally, it belonged to ';
    //echo $nonprofitname;' </b></h2>';


    while ( $row = mysqli_fetch_array( $result) ) {

        if ($row['np_id']!=$row1['np_id']) {
            echo '<h3><input type="radio" name="nonprofitids[]" value="' .
                $row['np_id'] . '"/>' . $row['name'] . '</h3>';
        }
        else {
            echo'<h3><input type = "radio" checked name = "nonprofitids[]" value="'.$row['np_id'].'"/>'.$row['name'].'</h3>';
        }


    }


}

//Add the submit button
if ( $button == 'Create a new profile' ) {
    //Display the add title
    echo '<h3><input type="submit" name="Button" class = "frontbutton" value="Create your profile"/></h3>';
} else {
    echo '<h3><input type="submit" name="Button" class = "frontbutton" value="Edit your profile"/></h3>';
}

echo '</form>';

echo'<a href = "user.php"><button class="gobacktosearchpage"> Go back to your account page</button></a>';

echo'</body></html>';


