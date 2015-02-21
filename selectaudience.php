<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/9/14
 * Time: 9:36 PM
 */

session_start();


if ( !isset( $_SESSION['username'] ) ) {
    //User is not logged in. Send to login page
    require('prelogin.html');
    require('postlogin.html');
    exit();
}//User is logged in properly. Display next page.

$button = $_POST['Button'];
$audience = '';
$type = '';
$action = '';

echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';

if ( $button == 'Change' ) {
    //Display the add title
    echo '<h2>Select a target group to change or update</h2>';
    $type='radio';
    $action='addchangeaudience.php';
} else {
    //Display the change title
    echo '<h2>Select target group to delete</h2>';
    $type = 'checkbox';
    $action = 'deleteaudience.php';
}
$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}

//Create the SQL INSERT statement
$sql = 'select * from audience';

$result = mysqli_query( $db, $sql );
if ( !$result ) {
    die( 'Services query failed. Error is: ' . mysqli_error($db) );
}
?>

<?php
echo '<form method="POST" action="' . $action . '">';

while ( $row = mysqli_fetch_array( $result) ) {
    echo '<h3><input name="audience[]" type="' . $type . '" value="'.
        $row['audience_id'] . '"/>' . $row['audience'] . '</h3>';
}

if ( $button == 'Delete' ) {
    echo '<input type="submit" name="Button" class = "frontbutton" value="Delete Target"/>';
} else {
    echo '<input type="submit" name="Button"  class = "frontbutton" value="Select Target"/>';
}
?>
</form>
<a href = "audience.php"><button class="gobacktosearchpage"> Go back to audience page</button></a>

</body>
</html>

