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
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  
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
                    <a class="nav-link" href="my_menu.php">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" role="button">Customer Diary<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addPage.html" role="button">Add Customer</a>
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
            <button onclick="Export()" class="btn btn-primary col-2-sm">Export to CSV File</button>
        </div>
    </nav>

    <div class="container">
        <br>
        <h2>
        <a class="btn btn-dark" href="my_menu.php">👈</a> Customer Diary 
        </h2>
        <br>




    <!--  /Content   -->
    
    <script>
        function Export()
        {
            var conf = confirm("Export users to CSV?");
            if(conf == true)
            {
                window.open("export.php", '_blank');
            }
        }
    </script>
</div>


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

    $sql = "SELECT * FROM $table_name";
    //$stmt = $connection->prepare($sql);
    //$stmt->execute();
    //$result = $stmt->get_result();

    echo "<div class='container'>
            <table class='table table-striped'>
                <thead>
                <tr>
                    <th scope='col'> FirstName </th>
                    <th scope='col'> LastName </th>
                    <th scope='col'> Phone </th>
                    <th scope='col'> Email </th>
                    <th scope='col'> Address </th>
                    <th scope='col'> City </th>
                    <th scope='col'> Provine </th>
                    <th scope='col'> PostalCode </th>
                    <th scope='col'> DateOfBirth </th>
                    <th scope='col'> Id </th>
                </tr>
                </thead>";

    $result = @mysqli_query($connection, $sql) or die(mysql_error());
  
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


            echo '<tr>
            <td>' .$firstName. '</td>
            <td>' .$lastName. '</td>
            <td>' .$phone. '</td>
            <td>' .$email. '</td>
            <td>' .$stAddress. '</td>
            <td>' .$city. '</td>
            <td>' .$province. '</td>
            <td>' .$postalCode. '</td>
            <td>' .$dateOfBirth. '</td>
            <td>' .$id. '</td>';
            echo '</tr>';
        
        }
        
        echo '</table>
                </div>';
?>


</body>