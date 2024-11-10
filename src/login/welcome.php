<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>
    <h1>Registered Therapists</h1>
    <?php
$host    = "localhost";
$user    = "root";
$pass    = "raspberry";
$db_name = "thinder";
//create connection
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connection = mysqli_connect($host, $user, $pass, $db_name);
//get results from database
$result = mysqli_query($connection, "SELECT * FROM therapist");
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