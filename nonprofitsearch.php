<html>
<head>
    <title>Non-profit search</title>

    <style>
body {
    max-width: 800px;
            margin: 20px auto;
        }
    </style>

</head>
<body>
<h1>Search for information about non-profits in South LA</h1>

Please enter the search parameters below:
<br/><br/>
<form action="nonprofitsearchresults.php">

    <?php
    $db = mysqli_connect("uscitp.com","sindujar","d@t@d3sk","sindujar_nonprofits");

    if (!$db) {
        exit ("Failed to connect to MySQL: " . mysqli_connect_error());
    };

    ?>

<h2><b> I want to know more about:</b></h2><select name="nonprofits">
    <option value="All">All</option>
    <?php
    $sql = "select np_id, name from Main_nonprofits";

    echo $sql;

    $results = mysqli_query($db, $sql);

    if (!$results) {
        exit ("SQL Query Error: " . mysqli_error($db));
    };

    while ($currentrow = mysqli_fetch_array($results)) {
        echo "<option value='" . $currentrow['np_id'] . "'>" .  $currentrow['name']  . "</option>";
    };

    ?>

</select>
<br /><br />

<input type="submit" value="Search" />

</form>

</body>
</html>


