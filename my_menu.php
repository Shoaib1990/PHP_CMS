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
    <meta charset="UTF-8">
    <title>CMS Menu</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</head>
<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        
        <a class="navbar-brand mr-5" href="#">CMS</a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="read.php" role="button">Customer Diary</a>
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
        </div>
    </nav>


    <div class="wrapper">
        
        <h2 class="text-center my-5">🏙 Truro Content Management System</h2>

        <div class="container">
            <div class="list-group">
                
                <a class="btn btn-primary col p-2 mb-2" href="read.php" role="button">📖 Customer Diary</a>
                <a class="btn btn-primary col p-2 mb-2" href="addPage.html" role="button">➕ Add Customer</a>
                <a class="btn btn-primary col p-2 mb-2" href="delete.php" role="button">➖ Delete Customer</a>
                <a class="btn btn-primary col p-2 mb-2" href="update.php" role="button">🖍 Edit Customer</a>
                <a class="btn btn-primary col p-2 mb-2" href="uploadFile.php" role="button">📤 Upload CSV</a>
                <a class="btn btn-primary col p-2 mb-2" href="sendEmail.html" role="button">📢 Broadcast Email</a>

                

            
            </div>
        </div>

    </div>    
</body>
</html>