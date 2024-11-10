<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../login/login.php");
    exit;

mysqli_query("ALTER TABLE thinder SET image = $image= "image/" . mysqli_query($connection, "SELECT username FROM therapist")");
echo "</img src="mysqli_query($connection, "SELECT image FROM therapist")>"; 

?>
</body>
</html>
