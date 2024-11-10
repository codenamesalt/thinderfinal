<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: tlogin.php");
    exit;
}
 
// Include config file
require_once "../login/config.php";
 
// Define variables and initialize with empty values
$new_username = $confirm_username = "";
$new_username_err = $confirm_username_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_username"]))){
        $new_username_err = "Please enter the new username.";     
    } elseif(strlen(trim($_POST["new_username"])) < 1){
        $new_username_err = "Usernames must have atleast 1 characters.";
    } else{
        $new_username = trim($_POST["new_username"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_username"]))){
        $confirm_username_err = "Please confirm the username.";
    } else{
        $confirm_username = trim($_POST["confirm_username"]);
        if(empty($new_username_err) && ($new_username != $confirm_username)){
            $confirm_username_err = "Usernames did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_username_err) && empty($confirm_username_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET username = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_username, $param_id);
            
            // Set parameters
            $param_username = $new_username;
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: ../login/tlogin.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Settings</title>
    <link rel="stylesheet" href="../navbar/navbar.css">
    <link rel="stylesheet" href="/src/login/login.css">
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
    <header>
        <div id="nav-placeholder"></div>
    </header>
    
    <script>
    $(function(){
      $("#nav-placeholder").load("snavbar.html");
    });
    </script>
    <div class="wrapper">
        <h2>Change Username</h2>
        <p>Please fill out this form to change your username.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Username</label>
                <input type="username" name="new_username" class="form-control <?php echo (!empty($new_username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_username; ?>">
                <span class="invalid-feedback"><?php echo $new_username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Username</label>
                <input type="username" name="confirm_username" class="form-control <?php echo (!empty($confirm_username_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_username_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-primary" value="Submit">
                <a class="btn-primary" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>