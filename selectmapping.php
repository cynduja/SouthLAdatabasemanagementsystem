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
$mapping = '';
$type = '';
$action = '';

if ( $button == 'Change' ) {
    //Display the add title
    echo '<h2>Select pairings to change or update</h2>';
    $type='radio';
    $action='addchangemapping.php';
} else {
    //Display the change title
    echo '<h2>Select pairings to delete</h2>';
    $type = 'checkbox';
    $action = 'selectmapping2.php';
}
$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}

//Create the SQL statement
$sql = 'select * from programs p';

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
    echo '<h3><input name="program[]" type="radio" value="'.
        $row['program_id'].'"/>' . $row['program']."</h3>";

}

    echo '<h3><input type="submit"  class = "frontbutton" name="Button" value="Select the program for which you need to delete service pairing"/></h3>';


?>
</form>
<a href = "mapping.php"><button class="gobacktosearchpage"> Go back to Mapping page</button></a>

</body>
</html>

