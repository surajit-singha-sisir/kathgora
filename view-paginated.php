

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
        <a href="index.html" class="w3-bar-item w3-button">Kathgora</a>
        <a href="#" class="w3-bar-item w3-button">Posts</a>
        <a href="#" class="w3-bar-item w3-button">Recent</a>
        <a href="#" class="w3-bar-item w3-button">Popular</a>
        <a href="#" class="w3-bar-item w3-button">Trends</a>
        <a href="#" class="w3-bar-item w3-button">About</a>

        <a href="registration.php" class="w3-bar-item w3-button w3-right"><i class="fa fa-user" aria-hidden="true"></i></a>
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

        <h1>View Records</h1>

<?php
// connect to the database
include('connect-db.php');

// number of results to show per page
$per_page = 5;

// figure out the total pages in the database
if ($result = $mysqli->query("SELECT * FROM players ORDER BY id"))
{
if ($result->num_rows != 0)
{
$total_results = $result->num_rows;
// ceil() returns the next highest integer value by rounding up value if necessary
$total_pages = ceil($total_results / $per_page);

// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
if (isset($_GET['page']) && is_numeric($_GET['page']))
{
$show_page = $_GET['page'];

// make sure the $show_page value is valid
if ($show_page > 0 && $show_page <= $total_pages)
{
$start = ($show_page -1) * $per_page;
$end = $start + $per_page;
}
else
{
// error - show first set of results
$start = 0;
$end = $per_page;
}
}
else
{
// if page isn't set, show first set of results
$start = 0;
$end = $per_page;
}

// display pagination
echo "<p><button><a href='view.php'>View All</a></button> | <button><b>View Page:</b></button> ";
for ($i = 1; $i <= $total_pages; $i++)
{
if (isset($_GET['page']) && $_GET['page'] == $i)
{
echo $i . " ";
}
else
{
echo "<a href='view-paginated.php?page=$i'>$i</a> ";
}
}
echo "</p>";

// display data in table
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>ID</th> <th>First Name</th> <th>Last Name</th> <th></th> <th></th></tr>";

// loop through results of database query, displaying them in the table
for ($i = $start; $i < $end; $i++)
{
// make sure that PHP doesn't try to show results that don't exist
if ($i == $total_results) { break; }

// find specific row
$result->data_seek($i);
$row = $result->fetch_row();

// echo out the contents of each row into a table
echo "<tr>";
echo '<td>' . $row[0] . '</td>';
echo '<td>' . $row[1] . '</td>';
echo '<td>' . $row[2] . '</td>';
echo '<td><a href="records.php?id=' . $row[0] . '">Edit</a></td>';
echo '<td><a href="delete.php?id=' . $row[0] . '">Delete</a></td>';
echo "</tr>";
}

// close table>
echo "</table>";
}
else
{
echo "No results to display!";
}
}
// error with the query
else
{
echo "Error: " . $mysqli->error;
}

// close database connection
$mysqli->close();

?>
<button>
<a href="records.php">Add New Record</a>
</button>

  
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
