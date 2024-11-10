<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="swipe.css">
    <link rel="stylesheet" href="../navbar/navbar.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
<header>
    <div id="nav-placeholder"></div>
    </header>
    
    <script>
    $(function(){
      $("#nav-placeholder").load("../navbar/navbar.html");
    });
    </script>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <a href="../swipe/swipe.php" class="btn">Start Swiping</a>
        <a href="../settings/susername.php" class="btn btn-warning">Settings</a>
    </p>
    <h1>Registered Therapists</h1>
    <?php
require_once "welcomeconfig.php";

//create connection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connection = mysqli_connect($host, $user, $password, $db_name);

//get results from database
$result = mysqli_query($connection, "SELECT username, email, phonenumber, city, state FROM therapist");

//showing property
echo '<table class="data-table">
        <tr class="data-heading">';  //initialize table tag
while ($property = mysqli_fetch_field($result)) {
    echo '<td>' . htmlspecialchars($property->name) . '</td>';  //get field name for header
}
echo '</tr>'; //end tr tag

//showing all data
while ($row = mysqli_fetch_row($result)) {
    echo "<tr>";
    foreach ($row as $item) {
        echo '<td>' . htmlspecialchars($item) . '</td>'; //get items 
    }
    echo '</tr>';
}
echo "</table>";
?>
</body>
</html>
