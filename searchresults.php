<html>
<head>
		<title>Here are the results of your search</title>
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
		FROM Main_nonprofits m, services s, programs p,audience a, program_has_services ps
		WHERE s.services_id = ps.services_id
			AND p.program_id = ps.program_id
			AND m.np_id = p.np_id
			AND p.audience_id = a.audience_id";


if ($_REQUEST['services'] != "All"){
    $sql = $sql." and s.services_id=".$_REQUEST['services'];
}

if ($_REQUEST['audience'] != "All"){
    $sql = $sql." and a.audience_id=".$_REQUEST['audience'];
}


$results = mysqli_query($db, $sql);

if (!$results) {
    exit ("SQL Query Error: " . mysqli_error($db));
};

if (mysqli_num_rows($results)==0)

{echo '<h2>Sorry, there are no programs matching your criteria. Try again</h2>';
require 'index.php';}


else {

//echo " Search returned " . mysqli_num_rows($results) . " records<br /> <br />";
echo "<h2>We've found the following programs for you</h2><br/>";

?>



<table bgcolor="#fffaf0" border = "1" cellpadding="9" cellspacing="5">
    <tr  cellpadding = "9" cellspacing = "5" bgcolor="#dcdcdc">
        <td><strong>Program name<hr/></strong></td>
        <td><strong>Program description<hr /></strong></td>
        <td><strong>Non-profit Name<hr/></strong></td>
        <td><strong>Address<hr /></strong></td>
    </tr>
<br style="clear:all">

<?php
while ($currentrow = mysqli_fetch_array($results)) {

    $currentprogramid = $currentrow['program_id'];

    if ($prevprogramid!=$currentprogramid) {

        echo '<tr>';
        echo "<td><strong>" . $currentrow['program'] . "</strong></td>";
        echo "<td>" . $currentrow['program_description'] . "</td>";
        echo "<td>" . $currentrow['name'] . "</td>";
        echo "<td>" . $currentrow['address'] . "</td>";
        echo "</tr>";
        $prevprogramid = $currentrow['program_id'];
    }

}
}
?>


</body>
</html>
