
/**
 * Created by PhpStorm.
 * User: sindujarangarajan
 * Date: 12/5/14
 * Time: 5:38 PM
 */
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    First Name: <input type="text" name="fname"/><br/>
        Last Name: <input type="text" name="lname"/><br/>
        Email: <input type="email" name="email"/><br/>
        Gender: <input type="radio" name="gender" value="male"/> Male <input type="radio" name="gender" value="female"/> Female<br/>
        <input type="submit">
</form>

<?php
echo "First name is: <strong>" . $_REQUEST['fname'] . "</strong>.";
echo "<br/>Last name is: <strong>" . $_REQUEST['lname'] . "</strong>.";
echo "<br/>The email is: <strong>" . $_REQUEST['email'] . "</strong>";
?>

</body>
</html>
