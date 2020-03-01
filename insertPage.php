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
    <title>New</title>

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
                    <a class="nav-link" href="my_menu.php" role="button">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="read.php" role="button">Customer Diary</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#"><span class="sr-only">(current)</span>Add Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="delete.php" role="button">Delete Customer</a>
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


if ((!$_POST['fname']) || (!$_POST['lname']) || (!$_POST['phone']) || (!$_POST['email']) || (!$_POST['postal']) || (!$_POST['province']) ||  (!$_POST['address']) ||  (!$_POST['dob'])) {
   header("Location: /addPage.html");
   exit;
}


// define variables and set to empty values
$firstNameErr = $lastNameErr = $phoneErr = $emailErr = $postalErr = $provinceErr = $addressErr = $dateOfBirthErr = "";
        
$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$postalCode = $_POST['postal'];
$province = $_POST['province'];
$streetAddress = $_POST['address'];
$dateOfBirth = $_POST['dob'];

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     if(empty($_POST['fname'])) {
//         $firstNameErr = "First name is required";
//         echo $firstNameErr;
//      } elseif(empty($_POST['lname'])) {
//         $lastNameErr = "Last name is required";
//         echo $lastNameErr;
//      } elseif(empty($_POST['phone'])) {
//         $phoneErr = "Phone number is required";
//         echo $phoneErr;
//      } elseif(empty($_POST['email'])) {
//         $emailErr = "Email is required";
//         echo $emailErr;
//      } elseif(empty($_POST['postal'])) {
//         $postalErr = "Postal code is required";
//         echo $postalErr;
//      } elseif(empty($_POST['province'])) {
//         $provinceErr = "Province is required";
//         echo $provinceErr;
//      } elseif(empty($_POST['address'])) {
//         $addressErr = "Address is required";
//         echo $addressErr;
//      } elseif(empty($_POST['dob'])) {
//         $dateOfBirthErr = "DOB is required";
//         echo $dateOfBirthErr;
//      } else {
    

        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        $firstName = $_POST['fname'];
        $lastName = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $postalCode = $_POST['postal'];
        $city = $_POST['cityName'];
        $province = $_POST['province'];
        $streetAddress = $_POST['address'];
        $dateOfBirth = $_POST['dob'];
                

        // prepare and bind
        $stmt = $connection->prepare("INSERT INTO $table_name (firstName, lastName, phone, email, stAddress, city, province, postalCode, dateOfBirth) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssss", $firstName, $lastName, $phone , $email, $streetAddress, $city, $province, $postalCode, $dateOfBirth);
        $stmt->execute();

        echo '<br><p>👌 New record added successfully!&nbsp;<a href="read.php">Click here</a></p>';

        $stmt->close();
        $connection->close();
//      }     
// }

        
?>
        </div>
    </body>
</html>
