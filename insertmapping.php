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

$program = $_POST['programid'];
$programid = $program[0];

$services = $_POST['services'];
$numberOfServices = count($services);

echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';


$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());

}


for ($i = 0; $i < $numberOfServices; $i++) {




    $sql = 'insert into program_has_services (program_id, services_id)
            values ("' . $programid . '","' . $services[$i].'" )';

    $result = mysqli_query($db,$sql);


    $sql1 = 'select * from program_has_services ps, programs p, services s
              where ps.program_id = p.program_id
              and ps.services_id = s.services_id
              and ps.program_id ="'.$programid.'"
              and ps.services_id="'.$services[$i].'"';
    $result1 = mysqli_query( $db, $sql1 );

    if ( !$result1 ) {
        die( 'Services query failed. Error is: ' . mysqli_error($db) );
    }

    $row1 = mysqli_fetch_array($result1) ;


   // echo $row1['program'];
    //echo $row1['service'];


    //Mysqli code to connect to database and execute the query

    if ($result) {
        echo '<h2>New pairing of '.$row1['program'].'  and  '.$row1['service'].' created successfully.</h2>';
    } else {
        //echo "Error: " . $sql . "<br>" . mysqli_error($db);
        echo'<h2>This pairing of '.$row1['program'].' and '.$row1['service'].' already exists. Try another one.</h2>';
    }

}


    mysqli_close($db);

//Send the user back to services.html
require('mapping.php');
?>

