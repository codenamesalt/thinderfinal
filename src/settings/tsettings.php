<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION['loggedin'] !== true){
    header("location: ../login/login.php");
    exit;
}

require_once "../login/config.php";
$username = "";
$username_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM therapist WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    if(empty($username_err)){
        $query = "UPDATE therapist SET username = ? WHERE id = ?";

        if($stmt = mysqli_prepare($link, $query)){
            mysqli_stmt_bind_param($stmt, "si", $param_username, $param_id);
            $param_username = $username;
            $param_id = $_SESSION["id"];

            if(mysqli_stmt_execute($stmt)){
                return;
            } else {
                echo "Unknown error occured, please try again later.";
            }
        }
    }
    
}


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Therapist Settings</title>
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class = "form-group">
                <h1>Username: <b><?php echo htmlspecialchars($_SESSION["username"]);?></b></h1>
                <input type="text" name="new_username" value="<?php echo $username; ?>">
            </div>
            <div class="form-group">
                <input type="submit" class = "btn btn-primary" value = "submit"/>
            </div>
        </form>
    </body>
</html>