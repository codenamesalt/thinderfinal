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
$new_state = $confirm_state = "";
$new_state_err = $confirm_state_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_state"]))){
        $new_state_err = "Please enter the new state etc. KS for Kansas.";     
    } elseif(strlen(trim($_POST["new_state"])) < 1){
        $new_state_err = "States must have atleast 1 characters.";
    } else{
        $new_state = trim($_POST["new_state"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_state"]))){
        $confirm_state_err = "Please confirm the state.";
    } else{
        $confirm_city = trim($_POST["confirm_state"]);
        if(empty($new_state_err) && ($new_state != $confirm_state)){
            $confirm_state_err = "States do not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_state_err) && empty($confirm_state_err)){
        // Prepare an update statement
        $sql = "UPDATE therapist SET state = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_state, $param_id);
            
            // Set parameters
            $param_state = $new_state;
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
    <link rel="stylesheet" href="../login/welcome.css">
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
      $("#nav-placeholder").load("tsnavbar.html");
    });
    </script>
    <div class="wrapper">
        <h2>Change state</h2>
        <p>Please fill out this form to change your state.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New state</label>
                <input type="state" name="new_state" class="form-control <?php echo (!empty($new_state_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_state; ?>">
                <span class="invalid-feedback"><?php echo $new_city_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm state</label>
                <input type="state" name="confirm_state" class="form-control <?php echo (!empty($confirm_state_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_state_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-primary" value="Submit">
                <a class="btn-primary" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>

