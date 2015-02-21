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

$services = $_POST['services'];
$numberOfServices = count($services);

echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';

//Connect to database
$db = mysqli_connect('uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

for ($i=0; $i<$numberOfServices; $i++ ) {
    //Generate the delete SQL statement using the services_id
    $sql = 'delete from services where services_id=' . $services[$i];
    //echo $sql;

    //Execute sql statement
    if (mysqli_query($db, $sql)) {
       //echo "New record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($db);
    }

}

echo "<h2>New record/s deleted successfully</h2>";
echo'</body></html>';

  mysqli_close($db);

//Send the user back to services.html
    require('services.php');
