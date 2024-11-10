<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: tlogin.php");
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
    <header>
        <div id="nav-placeholder"></div>
    </header>
    
    <script>
    $(function(){
      $("#nav-placeholder").load("../navbar/navbar.html");
    });
    </script>
<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    <p>
<<<<<<< HEAD
        <a href="treset-password.php" class="btn-primary">Reset Your Password</a>
        <a href="tlogin.php" class="btn-primary">Sign Out of Your Account</a>
        <a href="../settings/tusername.php" class="btn-primary">Settings</a>
=======
        <a href="treset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="tlogout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
        <a href="../settings/tusername.php" class="btn btn-warning">Settings</a>
>>>>>>> 19054c3c259e23be9c6736a690fe34b95a153a2d
    </p>
</body>
</html>
