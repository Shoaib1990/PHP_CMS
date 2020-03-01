<?php 

    // username = 'user';
    // password = 'test'

    //global $link;
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: my_menu.php");
    exit;
}

require_once 'configlogin.php';
// $host=$config['DB_HOST'];
// $db_name=$config['DB_DATABASE'];
$table_name = "tbllogin";

$username = $password = "";
$username_err = $password_err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }


if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
    
    $sql = "SELECT id, username, password FROM $table_name WHERE username = ?";
    
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_username);
    
    // Set parameters
    $param_username = $username;

    if(mysqli_stmt_execute($stmt)){
        // Store result
        mysqli_stmt_store_result($stmt);

        if(mysqli_stmt_num_rows($stmt) == 1){                    
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
            
            if(mysqli_stmt_fetch($stmt)){
                if(password_verify($password, $hashed_password)){
            
                    session_start();

                    $_SESSION["loggedin"] = true;

                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;

                    header("location: my_menu.php");

                } else{
                    // Display an error message if password is not valid
                    $password_err = "🙈 The password you entered was not valid.";
                }
    }
} else{
    $username_err = "🤷‍♀️ No account found with that username.";
}
} else{
    echo "🤦‍♂️ Oops! Something went wrong. Please try again later.";
    }
}

// Close statement
    mysqli_stmt_close($stmt);
}
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="submit">
            </div>
            
        </form>
    </div>    
</body>
</html>










