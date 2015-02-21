<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 10/16/14
 * Time: 8:49 AM
 */

echo 'This is first.php';
$titlename = $_POST['rink'];
echo 'You entered a rink name of'.$_POST['rink'];
echo 'You entered a rink name of"'.$_POST['rink'].'"';
$db = mysqli_connect('uscitp.com', 'mike_username', "password", "mike_hockey");
echo '<p>'.mysqli_connect_error().'</p>';
if (mysqli_connect_errno()!=0){//There was an error connecting to the database
    die ("Error connecting to the database. The error is:".mysql_connect_error());}
$sql = "select * from rinks where rink = '$rinkname'";
$sql = "select * from rinks";
echo '<p>'.$sql.'</p>';
$results = mysqli_query($db, $sql);//just parses sql. doesn't do anything else.
if (!$results){
    die('Query failed. Error is:'.mysql_error($db));
}
echo "Your search found".mysqli_num_rows($results).'rows';
while($row = mysqli_fetch_array($results)){ //only with the fetch array, we output rows
    echo $row['rink_name'];
} ?>
//or
<table>
    <tr><th>Rink ID</th><th>Rink name</th></tr>
    <?php
    while($row = mysqli_fetch_array($results)) {

        <?
        php
    echo '<tr> <td>' . $row['rink_id'] . '</td> <td></td>' .
        $row['rink_name'] . '</td></tr>';
    }
    ?> //using these start and close php tags to switch between html and php


    <p> This is my paragraph.</p>

