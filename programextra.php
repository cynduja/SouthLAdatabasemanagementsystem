<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/11/14
 * Time: 8:32 PM
 */

<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/11/14
 * Time: 12:11 AM
 */

    session_start();

    if ( !isset( $_SESSION['username'] ) ) {
        //User is not logged in. Send to login page
        require('prelogin.html');
        require('postlogin.html');
        exit();
    }

    //User is logged in properly. Display next page.
?>

<?php
$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}

//Create the SQL INSERT statement
$sql = 'select * from Main_nonprofits';

$result = mysqli_query( $db, $sql );
if ( !$result ) {
    die( 'Services query failed. Error is: ' . mysqli_error($db) );
}
?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h2>Select a non-profit that you would like to modify programs for:</h2>
<?php
echo '<form method="POST" action="programs1.php">';

while ( $row = mysqli_fetch_array( $result) ) {
    echo '<p><input name="nonprofits[]" type="radio" value="'.
        $row['np_id'] . '"/>' . $row['name'] . '</p>';
    echo '<input type="submit" name="Button" value="Select Nonprofit"/>';
}
?>
</form>

</body>
</html>