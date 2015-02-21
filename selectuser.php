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
$user = '';
$type = '';
$action = '';
$nonprofitnames = '';

if ( $button == 'Change' ) {
    //Display the add title
    echo '<h2>Edit profile</h2>';
    $type='radio';
    $action='addchangeuser.php';
} else {
    //Display the change title
    echo '<h2>Select programs to delete</h2>';
    $type = 'checkbox';
    $action = 'deleteuser.php';
}
$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}

//Create the SQL statement
$sql = 'select * from programs p, Main_nonprofits m where p.np_id = m.np_id';

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
    echo '<h3><input name="programs[]" type="' . $type . '" value="'.
        $row['program_id'] . '"/>' . $row['program'];
    echo' <b> from the nonprofit </b>'.$row['name'].'</h3>';
}

if ( $button == 'Delete' ) {
    echo '<h3><input type="submit" name="Button" class = "frontbutton" value="Delete Programs"/></h3>';
}
else {
    echo '<h3></p><input type="submit" name="Button" class = "frontbutton" value="Select Programs"/></h3>';
}
?>
</form>
</body>
</html>

