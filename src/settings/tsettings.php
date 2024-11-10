<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] !== true){
    header("location: ../login/login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Therapist Settings</title>
    </head>
    <body>
        <form>
            <div class = "form-group">
                <h1>Username: <b><?php echo htmlspecialchars($_SESSION["username"]);?></b></h1>
            </div>
        </form>
    </body>
</html>