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
    <link rel="stylesheet" href="welcome.css">
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
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Swipe.</h1>
    <p>
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <!-- <a href="../swipe/swipePage.php" class="btn">Start Swiping</a> -->
        <a href="../settings/susername.php" class="btn btn-warning">Settings</a>
    </p>
    <h1>Registered Therapists</h1>
    <?php
//create connection
$host    = "localhost";
$username = "root";
$password = "raspberry";
$database = "thinder";
$db_name = "thinder";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli($host, $user, $password, $db_name);
$connection = mysqli_connect($host, $user, $password, $db_name);

// Update the image path for the therapist with id=1
$mysqli->query("UPDATE thinder SET image='image/Bill_Clinton.jpg' WHERE id=1");

// Fetch the image path from the database
$result = $mysqli->query("SELECT image FROM thinder WHERE id=1");

if ($result) {
    $row = $result->fetch_assoc();
    $image_path = $row['image'];

    // Display the image
    echo "<img src='$image_path'>";
}

?>
</body>
</html>
