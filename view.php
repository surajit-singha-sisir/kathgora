<html>

<title>Kathgora The Untold Stories</title>
<!-- Head -->

<head>
    <link rel="stylesheet" href="stylesheet.css">
    <link rel="stylesheet" href="stylesheet2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>


<!-- Body -->

<body style="font-family:Verdana;">

    <div style="background-color:#333642;padding:15px;">
        <a href="#"><img height="100px" src="kathgora1.png" /></a>
        <p style="align-content: right; text-align: right;">

        </p>
    </div>

    <!-- Menu bar -->
    <div class="w3-bar w3-black">
        <a href="index.php" class="w3-bar-item w3-button">Kathgora</a>
        <a href="index.php" class="w3-bar-item w3-button">Posts</a>
        <a href="#" class="w3-bar-item w3-button">Recent</a>
        <a href="#" class="w3-bar-item w3-button">Popular</a>
        <a href="#" class="w3-bar-item w3-button">Trends</a>
        <a href="#" class="w3-bar-item w3-button">About</a>

        <a href="index.php" class="w3-bar-item w3-button w3-right"><i class="fa fa-user" aria-hidden="true"></i></a>
        <a href="#" class="w3-bar-item w3-button w3-right"><i class="fa fa-bell" aria-hidden="true"></i></a>
        <a href="#" class="w3-bar-item w3-button w3-right"><i class="fa fa-pencil" aria-hidden="true"></i></a>
        <a href="#" class="w3-bar-item w3-button w3-right"><i class="fa fa-envelope" aria-hidden="true"></i></a>
        <a href="#" class="w3-bar-item w3-button w3-right"><i class="fa fa-comment" aria-hidden="true"></i></a>

    </div>

    <!-- Left Design -->
    <div style="overflow:auto">
        <div class="menu">
            <a href="#">
                <div class="menuitem"><i class="fa fa-newspaper-o" aria-hidden="true"></i> All Posts</div>
            </a>
            <a href="users.php">
                <div class="menuitem"><i class="fa fa-user" aria-hidden="true"></i> Members</div>
            </a>
            <a href="#">
                <div class="menuitem"><i class="fa fa-check-circle" aria-hidden="true"></i> Approved</div>
            </a>
            <a href="#">
                <div class="menuitem"><i class="fa fa-paper-plane" aria-hidden="true"></i> Modarating</div>
            </a>
            <a href="#">
                <div class="menuitem"><i class="fa fa-minus-circle" aria-hidden="true"></i> Unaproved</div>
            </a>
            <a href="#">
                <div class="menuitem"><i class="fa fa-question-circle" aria-hidden="true"></i> Threats</div>
            </a>
            <a href="#">
                <div class="menuitem"><i class="fa fa-share-square" aria-hidden="true"></i> Mobility</div>
            </a>
            <a href="#">
                <div class="menuitem"><i class="fa fa-address-book" aria-hidden="true"></i> Address</div>
            </a>
            <a href="#">
                <div class="menuitem"><i class="fa fa-rocket" aria-hidden="true"></i> Newest</div>
            </a>
            <a href="#">
                <div class="menuitem"><i class="fa fa-tag" aria-hidden="true"></i> Oldest</div>
            </a>
        </div>

        <!-- Main Design -->
        <div class="main">

        <h1>View Records </h1>

<p><button><b>View All</b></button> | <button><a href="view-paginated.php">View Paginated</a></button></p>

<?php
// connect to the database
include('connect-db.php');

// get the records from the database
if ($result = $mysqli->query("SELECT * FROM players ORDER BY id"))
{
// display records if there are records to display
if ($result->num_rows > 0)
{
// display records in a table
echo "<table border='1' cellpadding='10'>";

// set table headers
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th></th><th></th></tr>";

while ($row = $result->fetch_object())
{
// set up a row for each record
echo "<tr>";
echo "<td>" . $row->id . "</td>";
echo "<td>" . $row->firstname . "</td>";
echo "<td>" . $row->lastname . "</td>";
echo "<td><a href='records.php?id=" . $row->id . "'>Edit</a></td>";
echo "<td><a href='delete.php?id=" . $row->id . "'>Delete</a></td>";
echo "</tr>";
}

echo "</table>";
}
// if there are no records in the database, display an alert message
else
{
echo "No results to display!";
}
}
// show an error if there is an issue with the database query
else
{
echo "Error: " . $mysqli->error;
}

// close database connection
$mysqli->close();

?>

<button><a href="records.php">Add New Record</a></button>
</div>



    <!-- Fotter Design -->
    <div style="background-color:#white;text-align:center;padding:5px;margin-top:7px;font-size:15px; color: #green;">
        Copyright <a href="#">
            <p style="color:red">KATHGORA ©2020</p>
        </a></div>

</body>




<!-- All the JS Java script -->
<script>
    function openCity(evt, cityName) {
        var i, x, tablinks;
        x = document.getElementsByClassName("city");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < x.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" w3-red", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " w3-red";
    }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

</html>
