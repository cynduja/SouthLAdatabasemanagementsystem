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


echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';


if ( $button == 'Add' ) {
    //Display the add title
    echo '<h2>Add a new program</h2>';
    echo '<form action="insertprograms.php" method="POST">';
    echo '<h3> <b>Enter Program Name: <input type="text" name="program" value="' .
       $program . '"/></b></h3>';

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

    echo '<h2><b> Pick a non-profit that the program belongs to</b></h2>';


    while ( $row = mysqli_fetch_array( $result) ) {
     echo '<h3><input type="radio" name="nonprofitids[]" value="'.
           $row['np_id']. '"/>' .$row['name']. '</h3>';

    }

    //Display the audience list

    $sql = 'select * from audience';
    $result = mysqli_query( $db, $sql );
    if ( !$result ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }

    echo '<h3><b> Pick a target group that the program belongs to</b></h3>';

    while ( $row = mysqli_fetch_array( $result) ) {
        echo '<h3><input type="radio" name="audiences[]" value="'.
          $row['audience_id'] . '"/>' . $row['audience'].'</h3>';
    }
    echo '<h3><b> Program Description: <input type="text" name="programdescription" value="' .
       $programdescription . '"/></b></h3>';
}

//CHANGE/UPDATE CODE:

else {
    //Display the change title
    echo '<h2>Change or update a non-profit</h2>';

    //Connect to the database and retrieve the services name
    $db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

    if ( mysqli_connect_errno() != 0 ) {
        //There was an error connecting to the database
        die("Error connecting to the database. The error is: " . mysqli_connect_error());
    }
    $sql = 'select * from programs where program_id =' .$programid;

    $result = mysqli_query( $db, $sql );
    if ( !$result ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }

    $row = mysqli_fetch_array( $result );
    $program = $row['program'];
    $programid = $row ['program_id'];
    //$np_id = $row ['np_id'];
    $programdescription = $row['program_description'];
    //$audience_id = $row['audience_id'];

    echo '<form action="updateprograms.php" method="POST">';
    echo '<input type="hidden" name="programid" value="' . $programid . '"/>';
    echo '<h3>Program Name: <input type="textarea" name="program" value="' .
        $program . '"/><h3>';
    echo '<h3>Program Description: <input type="text" name="programdescription" value="' .
        $programdescription . '"/></h3>';

    //Editing the non-profit the program belongs to:

    echo'<h2>Edit the non-profit that the program belongs to:</h2>';

    $db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

    if ( mysqli_connect_errno() != 0 ) {
        //There was an error connecting to the database
        die("Error connecting to the database. The error is: " . mysqli_connect_error());
    }
    $sqlnonprofitname = 'select * from programs p, Main_nonprofits m where p.np_id = m.np_id and program_id='.$programid;
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

    //Display the audience list
    echo'<h2>Edit the target group that the program caters to:</h2>';

    $sqlaudiencename = 'select * from programs p, audience a where p.audience_id = a.audience_id and program_id='.$programid;
    $result1 = mysqli_query( $db, $sqlaudiencename );


    if ( !$result1 ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }

    $row1 = mysqli_fetch_array($result1);


    $sql = 'select * from audience';
    $result = mysqli_query( $db, $sql );
    if ( !$result ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }



    while ( $row = mysqli_fetch_array( $result) ) {

        if ($row['audience_id']!=$row1['audience_id']) {
            echo '<h3><input type="radio" name="audiences[]" value="' .
                $row['audience_id'] . '"/>' . $row['audience'] . '</h3>';
        }
        else {
            echo'<h3><input type = "radio" checked name = "audiences[]" value="'.$row['audience_id'].'"/>'.$row['audience'].'</h3>';
        }
    }


}

//Add the submit button
if ( $button == 'Add' ) {
    //Display the add title
    echo '<h3><input type="submit" name="Button" class = "frontbutton" value="Add Programs"/></h3>';
} else {
    echo '<h3><input type="submit" name="Button" class = "frontbutton" value="Change Programs"/></h3>';
}

echo '</form>';

echo'<a href = "programs.php"><button class="gobacktosearchpage"> Go back to programs page</button></a>';

echo'</body></html>';



