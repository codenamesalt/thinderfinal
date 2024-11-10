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
$new_phonenumber = $confirm_phonenumber = "";
$new_phonenumber_err = $confirm_phonenumber_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_phonenumber"]))){
        $new_phonenumber_err = "Please enter the new phone number.";     
    } elseif(strlen(trim($_POST["new_p"])) < 1){
        $new_phonenumber_err = "Phone numbers must have atleast 1 characters.";
    } else{
        $new_phonenumber = trim($_POST["new_phonenumber"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_phonenumber"]))){
        $confirm_phonenumber_err = "Please confirm the phone number.";
    } else{
        $confirm_phonenumber = trim($_POST["confirm_phonenumber"]);
        if(empty($new_phonenumber_err) && ($new_phonenumber != $confirm_phonenumber)){
            $confirm_phonenumber_err = "Phone numbers do not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_phonenumber_err) && empty($confirm_phonenumber_err)){
        // Prepare an update statement
        $sql = "UPDATE therapist SET phonenumber = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_phonenumber, $param_id);
            
            // Set parameters
            $param_phonenumber = $new_phonenumber;
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
        <h2>Change phone number</h2>
        <p>Please fill out this form to change your phone number.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New phone number</label>
                <input type="phonenumber" name="new_phonenumber" class="form-control <?php echo (!empty($new_phonenumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_phonenumber; ?>">
                <span class="invalid-feedback"><?php echo $new_phonenumber_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm phone number</label>
                <input type="phonenumber" name="confirm_phonenumber" class="form-control <?php echo (!empty($confirm_phonenumber_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_phonenumber_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn-primary" value="Submit">
                <a class="btn-primary" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    
</body>
</html>