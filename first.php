<?php
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 10/8/14
 * Time: 3:25 PM
 */
echo 'This is first.php';
$titlename = $_POST['title'];
echo 'You entered a title name of '.$_POST['title'];
echo 'You entered a rink name of"'.$_POST['rink'].'"';
$db = mysqli_connect('uscitp.com', 'sindujar', "", "mike_hockey");

?>