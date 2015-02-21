<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/9/14
 * Time: 11:20 PM
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

$programid = $_POST['programid'];
$program = $_POST['program'];
$programdescription = $_POST['programdescription'];
$nonprofitids= $_POST['nonprofitids'];
$np_id = $nonprofitids[0];
$audiences = $_POST['audiences'];
$audience_id = $audiences[0];

//Connect to database
$db = mysqli_connect('uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

//Generate the update SQL statement using the services_id
$sql = 'update programs set program ="' . $program . '", np_id = "'.$np_id.'", program_description = "'.$programdescription. '", audience_id ="'.$audience_id.'" where program_id=' .$programid. '';

//Execute sql statement
if (mysqli_query($db, $sql)) {
    //echo "New record deleted successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($db);
}


echo "<h2>New record/s updated successfully</h2>";
echo'</body></html>';

mysqli_close($db);

//Send the user back to services.html
require('programs.php');
