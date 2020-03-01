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

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delete Customer</title>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <a class="navbar-brand mr-5" href="#">CMS</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="my_menu.php">Home</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="read.php" role="button">Customer Diary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addPage.html" role="button">Add Customer</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" role="button">Delete Customer<span class="sr-only">(current)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="update.php" role="button">Edit Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="uploadFile.php" role="button">Upload CSV</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="sendEmail.html" role="button">Broadcast Email</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="birthday.php" role="button">Birthday🎉</a>
                </li>

            </ul>
            <div class="text-right mr-4">
                <b id="logout"><a href="logout.php">Log Out</a></b>
            </div>
        </div>
    </nav>


    <div class="container">
        <br>
        <h2 class="ml-3">
            Delete Customer
        </h2>
        <br>
        <form method="post" style="color: blue; margin: 15px;">
            <select class="border border-primary rounded" name="deleteCustomer">
                <option value="">SELECT CUSTOMER</option>

    <?php

    
    require_once 'config.php';
    $host=$config['DB_HOST'];
    $db_name=$config['DB_DATABASE'];

    $db_name = "phpproject1";
    $table_name = "tblcustomer";
    $display_block = "";

    //connect to MySQL and select database to use
    $connection = mysqli_connect($host, $config['DB_USERNAME'], $config['DB_PASSWORD'])
        or die(mysqli_error($connection)); 
    $db = mysqli_select_db($connection, $db_name) or die(mysqli_error($connection));


    $result = @mysqli_query($connection, "SELECT * FROM $table_name") or die(mysql_error());

    
    while ($row = mysqli_fetch_array($result)) {
        
        $firstName = $row['firstName'];
        $lastName = $row['lastName'];
        $phone = $row['phone'];
        $email = $row['email'];
        $stAddress = $row['stAddress'];
        $city = $row['city'];
        $province = $row['province'];
        $postalCode = $row['postalCode'];
        $dateOfBirth = $row['dateOfBirth'];
        $id = $row['id'];

        echo "<option value='". $firstName ."'>" . $firstName ."</option>";

    }




?>
        </select>
        <input type="submit" class="btn btn-primary btn-sm rounded" name="submit" value="Submit"/>
        <a class="btn btn-outline-primary btn-sm" href="my_menu.php">Go back</a> 

<?php
    if(isset($_POST['submit'])) {
        $targetCustomer = $_POST['deleteCustomer'];
        echo "<p class='mt-3'>" .$targetCustomer;
        //echo "<input type='submit' name='delete' value='Yes'/>";
        
        $stmt = $connection->prepare("DELETE FROM $table_name WHERE firstName=?");
        $stmt->bind_param('s',$targetCustomer);
        $stmt->execute();
        $stmt->close();
        echo " has been deleted from records. </p>";
    
    }


?>
        </form>
    </div>
</body>
</html>


