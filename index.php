<html>
<head>
    <title>Search for resources and assistance in South LA</title>

    <link href="styles.css" rel="stylesheet" type="text/css">
<style>
    #about {position:absolute;
        right:260px;
        top:150px;
    }
</style>
</head>
<body>
<div class = "titlecontainer">
<h1>Search for resources and assistance in South LA</h1>

<h3>Enter your search parameters below:</h3>
    </div>

<form action="searchresults.php">

    <?php
    $db = mysqli_connect("uscitp.com","sindujar","d@t@d3sk","sindujar_nonprofits");

    if (!$db) {
        exit ("Failed to connect to MySQL: " . mysqli_connect_error());
    };

    ?>

   <div class = "titlecontainer"><h2><b> I am looking for:</b></h2></div><select name="services">
        <option value="All">All</option>
        <?php
        $sql = "select services_id, service from services";

        echo $sql;

        $results = mysqli_query($db, $sql);

        if (!$results) {
            exit ("SQL Query Error: " . mysqli_error($db));
        };

        while ($currentrow = mysqli_fetch_array($results)) {
            echo "<option value='" . $currentrow['services_id'] . "'>" .  $currentrow['service']  . "</option>";
        };

        ?>

    </select>
    <br /><br />

   <div class = "titlecontainer"><h2><b> For target group:</b></h2></div><select name="audience">
        <option value="All">Everyone (All target groups)</option>


        <?php
        $sql = "select audience_id, audience from audience";

        $results = mysqli_query($db, $sql);

        if (!$results) {
            exit ("SQL Query Error: " . mysqli_error($db));
        };

        while ($currentrow = mysqli_fetch_array($results)) {
            echo "<option value='" . $currentrow["audience_id"] . "'>" .  $currentrow["audience"]  . "</option>";
        }

        ?>

    </select>
    <br/><br/>

    <input type="submit" value="Search" class = "frontbutton"/>

</form>

<br/>
<br/>

<div class = "titlecontainer">

    <h1 class = "userhomepagepart2">Search for information about non-profits in South LA</h1>

    <h3 class = "userhomepagepart2">Please enter the search parameters below:</h3>

    <form action="nonprofitsearchresults.php">

        <?php
        $db = mysqli_connect("uscitp.com","sindujar","d@t@d3sk","sindujar_nonprofits");

        if (!$db) {
            exit ("Failed to connect to MySQL: " . mysqli_connect_error());
        };

        ?>

        <h2 class ="userhomepagepart2"><b> I want to know more about:</b></h2><select name="nonprofits">
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

        <input type="submit" class = " userhomepagebutton2 frontbutton" value="Search" />

    </form>
</div>

<div id = "adminlogin">
    <h3> Non-profit dataase administrators, login here</h3>
<a href = "login.php"><button class = "frontbutton">Admin login</button></a>
    </div>

<div id = "about">

    <a href = "about.html"><button class = "frontbutton">About this project</button></a>
</div>
</body>
</html>


