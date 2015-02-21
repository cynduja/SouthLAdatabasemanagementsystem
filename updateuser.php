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

$nonprofitids = $_POST['nonprofitids'];
$np_id = $nonprofitids[0];
$username = $_POST['username'];
$password = $_POST['password'];


//Connect to database
$db = mysqli_connect('uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

//Generate the update SQL statement using the services_id
$sql = 'update user set password = "'.$password.'", np_id = "'.$np_id. '"';

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
require('user.php');
