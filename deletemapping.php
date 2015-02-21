<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/9/14
 * Time: 9:49 PM
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

$selectedprogramid = $_POST['selectedprogramid'];
$services = $_POST['service'];

$numberOfservices= count($services);

//echo 'I print this'$services[0];
//echo $services[1];

//for ($i=0; $i<$numberOfServices; $i++ ) {

//}


//echo $numberOfservices;

//Connect to database
$db = mysqli_connect('uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

for ($i=0; $i<$numberOfservices; $i++ ) {
    //Generate the delete SQL statement using the services_id
    $sql = 'delete from program_has_services
            where services_id="' . $services[$i].'"
            and program_id = "'.$selectedprogramid.'"';



    //Execute sql statement
    if (mysqli_query($db, $sql)) {
       echo "<h2>".$i."+ New record deleted successfully</h2>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }

}

  mysqli_close($db);

echo'</body></html>';
//Send the user back to services.html
    require('mapping.php');
