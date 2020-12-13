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

        <a href="registration.php" class="w3-bar-item w3-button w3-right"><i class="fa fa-user"
                aria-hidden="true"></i></a>
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


            <?php
/*
Allows the user to both create new records and edit existing records
*/

// connect to the database
include("connect-db.php");

// creates the new/edit record form
// since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($first = '', $last ='', $error = '', $id = '')
{ ?>
            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
            <html>

            <head>
                <title>
                    <?php if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?>
                </title>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            </head>

            <body>


                <h1><?php if ($id != '') { echo "Edit Record"; } else { echo "New Record"; } ?></h1>
                <?php if ($error != '') {
echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error
. "</div>";
} ?>

                <form action="" method="post">
                    <div>
                        <?php if ($id != '') { ?>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <p>ID: <?php echo $id; ?></p>
                        <?php } ?>

                        <strong>First Name: *</strong> <input type="text" name="firstname"
                            value="<?php echo $first; ?>" /><br />
                        <strong>Last Name: *</strong> <input type="text" name="lastname" value="<?php echo $last; ?>" />
                        <p>* required</p>
                        <input type="submit" name="submit" value="Submit" />
                    </div>
                </form>
            </body>

            </html>

            <?php }



/*

EDIT RECORD

*/
// if the 'id' variable is set in the URL, we know that we need to edit a record
if (isset($_GET['id']))
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// make sure the 'id' in the URL is valid
if (is_numeric($_POST['id']))
{
// get variables from the URL/form
$id = $_POST['id'];
$firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
$lastname = htmlentities($_POST['lastname'], ENT_QUOTES);

// check that firstname and lastname are both not empty
if ($firstname == '' || $lastname == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($firstname, $lastname, $error, $id);
}
else
{
// if everything is fine, update the record in the database
if ($stmt = $mysqli->prepare("UPDATE players SET firstname = ?, lastname = ?
WHERE id=?"))
{
$stmt->bind_param("ssi", $firstname, $lastname, $id);
$stmt->execute();
$stmt->close();
}
// show an error message if the query has an error
else
{
echo "ERROR: could not prepare SQL statement.";
}

// redirect the user once the form is updated
header("Location: view.php");
}
}
// if the 'id' variable is not valid, show an error message
else
{
echo "Error!";
}
}
// if the form hasn't been submitted yet, get the info from the database and show the form
else
{
// make sure the 'id' value is valid
if (is_numeric($_GET['id']) && $_GET['id'] > 0)
{
// get 'id' from URL
$id = $_GET['id'];

// get the recod from the database
if($stmt = $mysqli->prepare("SELECT * FROM players WHERE id=?"))
{
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->bind_result($id, $firstname, $lastname);
$stmt->fetch();

// show the form
renderForm($firstname, $lastname, NULL, $id);

$stmt->close();
}
// show an error if the query has an error
else
{
echo "Error: could not prepare SQL statement";
}
}
// if the 'id' value is not valid, redirect the user back to the view.php page
else
{
header("Location: view.php");
}
}
}



/*

NEW RECORD

*/
// if the 'id' variable is not set in the URL, we must be creating a new record
else
{
// if the form's submit button is clicked, we need to process the form
if (isset($_POST['submit']))
{
// get the form data
$firstname = htmlentities($_POST['firstname'], ENT_QUOTES);
$lastname = htmlentities($_POST['lastname'], ENT_QUOTES);

// check that firstname and lastname are both not empty
if ($firstname == '' || $lastname == '')
{
// if they are empty, show an error message and display the form
$error = 'ERROR: Please fill in all required fields!';
renderForm($firstname, $lastname, $error);
}
else
{
// insert the new record into the database
if ($stmt = $mysqli->prepare("INSERT players (firstname, lastname) VALUES (?, ?)"))
{
$stmt->bind_param("ss", $firstname, $lastname);
$stmt->execute();
$stmt->close();
}
// show an error if the query has an error
else
{
echo "ERROR: Could not prepare SQL statement.";
}

// redirec the user
header("Location: view.php");
}

}
// if the form hasn't been submitted yet, show the form
else
{
renderForm();
}
}

// close the mysqli connection
$mysqli->close();
?>



        </div>


        <!-- Fotter Design -->
        <div style="background-color:white;text-align:center;padding:5px;margin-top:7px;font-size:15px; color: black;">
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