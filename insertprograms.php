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

$program = $_POST['program'];
$nonprofitids = $_POST['nonprofitids'];
$np_id = $nonprofitids[0];
$audiences=$_POST['audiences'];
$audience_id=$audiences[0];
$programdescription = $_POST['programdescription'];


$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');
echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}
    $sql = 'insert into programs (program, np_id, program_description, audience_id) values ("' .
        $program .'","'.$np_id.'","'.$programdescription.'","'.$audience_id.'")';


//echo $sql;

//Mysqli code to connect to database and execute the query

    if (mysqli_query($db, $sql)) {

        echo "<h2>New record created successfully</h2>";
        echo'</body></html>';
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }

    mysqli_close($db);

//Send the user back to services.html
require('programs.php');
?>

