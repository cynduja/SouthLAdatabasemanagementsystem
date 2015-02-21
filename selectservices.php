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

echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';

$button = $_POST['Button'];
$service = '';
$type = '';
$action = '';

if ( $button == 'Change' ) {
    //Display the add title
    echo '<h2>Select a service category to change or update</h2>';
    $type='radio';
    $action='addchangeservices.php';
} else {
    //Display the change title
    echo '<h2>Select services to delete</h2>';
    $type = 'checkbox';
    $action = 'deleteservices.php';
}
$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}

//Create the SQL INSERT statement
$sql = 'select * from services';

$result = mysqli_query( $db, $sql );
if ( !$result ) {
    die( 'Services query failed. Error is: ' . mysqli_error($db) );
}
?>
<html>
<body>
<?php
echo '<form method="POST" action="' . $action . '">';

while ( $row = mysqli_fetch_array( $result) ) {
    echo '<h3><input name="services[]" type="' . $type . '" value="'.
        $row['services_id'] . '"/>' . $row['service'] . '</h3>';
}

if ( $button == 'Delete' ) {
    echo '<input type="submit" name="Button" class = "frontbutton" value="Delete services"/>';
} else {
    echo '<input type="submit" name="Button" class = "frontbutton" value="Select service"/>';
}
?>
</form>
<a href = "services.php"><button class="gobacktosearchpage"> Go back to services page</button></a>

</body>
</html>

