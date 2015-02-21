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

$programid = $_POST['program'];
$selectedprogramid = $programid[0];

//echo $selectedprogramid;


echo '<html><head><link href="styles.css" rel="stylesheet" type="text/css">
</head><body>';

$db = mysqli_connect( 'uscitp.com', 'sindujar', 'd@t@d3sk', 'sindujar_nonprofits');

if ( mysqli_connect_errno() != 0 ) {
    //There was an error connecting to the database
    die("Error connecting to the database. The error is: " . mysqli_connect_error());
}

//Create the SQL statement
$sql = 'select ps.services_id, s.service from program_has_services ps, programs p, services s where ps.program_id = p.program_id and ps.services_id = s.services_id and ps.program_id='.$selectedprogramid;
//echo $sql;
$result = mysqli_query( $db, $sql );
if ( !$result ) {
    die( 'Services query failed. Error is: ' . mysqli_error($db) );
}
$row = mysqli_fetch_array( $result);

$numberofrows = mysqli_num_rows($result);

//echo $numberofrows;

if ( $numberofrows ==0)
{

    echo 'The program you have selected does not have any services yet. Do you want to add any today?';
    require'mapping.php';


}

else {


echo '<form method="POST" action="deletemapping.php">';

while ( $row = mysqli_fetch_array( $result) ) {
    echo '<h3><input name="service[]" type="checkbox" value="'.
        $row['services_id'].'"/>' . $row['service'].'</h3>';
}

echo '<h3><input name = "selectedprogramid" type = hidden value ="'.$selectedprogramid.'"/>';

//if ( $button == 'Delete' ) {
    echo '<h3><input type="submit" name="Button"  class = "frontbutton" value="Select the service for the program"/></h3>';
//}
//else {
    //echo '<p><input type="submit" name="Button" value="Select Pairing"/></p>';
//}


echo '</form>';

    echo'<a href = "mapping.php"><button class="gobacktosearchpage"> Go back to mapping page</button></a>';
echo'</body>';
echo'</html>';
}

?>
