

<html>
<head>
		<title>Results of your search</title>
    <link href="styles.css" rel="stylesheet" type="text/css">


    <style>
body {
    max-width: 800px;
	margin: 20px auto;
}

div {
    float:left;
    width:150px;
}

        .gobacktosearchpage{top:10px; width:200px;}


</style>

</head>
<body>
<a href = "index.php"><button class="gobacktosearchpage"> Go back to search page</button></a>


<?php
$db = mysqli_connect("uscitp.com","sindujar","d@t@d3sk","sindujar_nonprofits");

if (!$db) {
    exit ("Failed to connect to MySQL: " . mysqli_connect_error());
};

$sql = "SELECT *
		FROM Main_nonprofits m";



if ($_REQUEST['nonprofits'] != "All"){
    $sql = $sql." where m.np_id =".$_REQUEST['nonprofits'];
}


$results = mysqli_query($db, $sql);

if (!$results) {
    exit ("SQL Query Error: " . mysqli_error($db));
};

if (mysqli_num_rows($results)==0)

{
    echo '<h2>Sorry, there are no programs matching your criteria. Try again</h2>';
    require 'nonprofitsearch.php';}


else {

//echo " Search returned " . mysqli_num_rows($results) . " records<br /> <br />";
echo "<h2>We hope you find this useful</h2><br/><br/>";

?>


<table bgcolor = "#fffaf0" border = "1" cellpadding = "10" cellspacing = "10" width = "800">

    <tr   bgcolor="#dcdcdc" align = "center">
        <td><strong>Nonprofits information<hr/></strong></td>

    </tr>

</table>


<table bgcolor = "#fffaf0" border = "1" cellpadding="9" cellspacing="5" >

    <tr  cellpadding = "9" cellspacing = "5" bgcolor="#dcdcdc" align = "center">
        <td><strong>Name<hr/></strong></td>
        <td width = "70"><strong>Description<hr /></strong></td>
        <td width = "100"><strong>Phone number<hr/></strong></td>
        <td width = "100"><strong>Address<hr /></strong></td>
        <td width = "100"><strong>Email<hr /></strong></td>
    </tr>
    <br style="clear:all">

    <?php
    while ($currentrow = mysqli_fetch_array($results)) {

        $currentnpid = $currentrow['np_id'];

        if ($prevnpid!=$currentnpid) {

            echo '<tr>';
            echo "<td><strong>" . $currentrow['name'] . "</strong></td>";
            echo "<td>" . $currentrow['description'] . "</td>";
            echo "<td>" . $currentrow['phone_number'] . "</td>";
            echo "<td>" . $currentrow['address'] . "</td>";
            echo "<td>" . $currentrow['email'] . "</td>";
            echo "</tr>";
            $prevnpid = $currentrow['np_id'];
        }

    }
    }
    ?>


    </body>
    </html>
