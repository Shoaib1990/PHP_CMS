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
    <title>Edit Customer</title>

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
                <li class="nav-item">
                    <a class="nav-link" href="addPage.html" role="button">Add Customer</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="delete.php" role="button">Delete Customer</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="#" role="button">Edit Customer<span class="sr-only">(current)</a>
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
            Edit Customer Record 
        </h2>
        <br>

        <form class="" style="color: blue; margin: 15px;" method="post">
            <select class="border border-primary rounded m-6" name="updateCustomer" id="mySelect" onchange="myFunction()">
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

        echo "<option value='". $id ."'>$firstName $lastName </option>";

        echo "<br>";
        echo "<div>$city</div>";
    }


?>
</select>

<input type="submit" class="btn btn-primary btn-sm rounded" name="submit" value="Submit"/>
<a class="btn btn-outline-primary btn-sm" href="my_menu.php">Go back</a> 






<?php
//echo $firstName;

    
        if(isset($_POST['submit'])) {
            $targetCustomer = $_POST['updateCustomer'];
            
            
            //echo "Are you sure you want to update: " .$targetCustomer;
            //echo "<input type='submit' name='delete' value='Yes'/>";
            
            // $stmt = $connection->prepare("UPDATE $table_name SET firstName=?, lastName=?, phone=?, email=?, stAddress=?, city=?, province=?, postalCode=?, dateOfBirth=? WHERE id=?");
            // $stmt->bind_param('sssssssssd',$firstName, $lastName, $phone , $email, $streetAddress, $city, $province, $postalCode, $dateOfBirth, $targetCustomer);
            // $stmt->execute();
            // $stmt->close();

            $stmt = $connection->prepare("SELECT * FROM $table_name WHERE id=?");
            $stmt->bind_param('i',$targetCustomer);
            $stmt->execute();
            //$stmt->close();
            $result = $stmt->get_result();
            //$user = $result->fetch_assoc();
            
            while($row = $result->fetch_assoc()) {

                
        ?>
                    

                    <input type="text" hidden name="targetCustomer" value=<?php echo $targetCustomer ?>>

                    <div class="form-group mt-5">
                        <label>First Name</label>
                        <input class="border border-primary rounded" type="text" name="updateFN" required maxlength="20" value=<?php echo $row['firstName']?>>
                    </div>

                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="border border-primary rounded" type="text" name="updateLN" required maxlength="20" value=<?php echo $row['lastName']?>>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input class="border border-primary rounded" type="text" name="updatePh" required maxlength="20" value=<?php echo $row['phone']?>>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input class="border border-primary rounded" type="text" name="updateEmail" required maxlength="20" value=<?php echo $row['email']?>>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <input class="border border-primary rounded" type="text" name="updateAdd" required maxlength="50" value=<?php echo $row['stAddress']?>>
                    </div>

                    <div class="form-group">
                        <label>City</label>
                        <input class="border border-primary rounded" type="text" name="updateCity" required maxlength="20" value=<?php echo $row['city']?>>
                    </div>

                    <div class="form-group">
                        <label>Province</label>
                        <input class="border border-primary rounded" type="text" name="updateProv" required maxlength="20" value=<?php echo $row['province']?>>
                    </div>

                    <div class="form-group">
                        <label>Postal code</label>
                        <input class="border border-primary rounded" type="text" name="updatePostal" required maxlength="20" value=<?php echo $row['postalCode']?>>
                    </div>

                    <div class="form-group">
                        <label>Date of birth</label>
                        <input class="border border-primary rounded" type="text" name="updateDob" required maxlength="20" value=<?php echo $row['dateOfBirth']?>>
                    </div>

                    
                    <div>
                        <input class="btn btn-primary rounded" type="submit" name="update" value="Update">
                        <a class="btn btn-outline-primary" href="my_menu.php">Cancel</a> 
                    </div>
                    
                
        <?php

            }
       
    }



?>

        <p id="demo"></p>
    </form>
</div>
<?php 



if(isset($_POST['update'])) {
    echo '<p class="d-flex justify-content-center"><strong>' . $_POST['updateLN'];
    $updateSql = $connection->prepare("UPDATE $table_name SET firstname=?, lastname=?, phone=?, email=?, stAddress=?, city=?, province=?, postalCode=?, dateOfBirth=? WHERE id = ?");
    $updateSql->bind_param('sssssssssd',$_POST['updateFN'],$_POST['updateLN'],$_POST['updatePh'],$_POST['updateEmail'], $_POST['updateAdd'],$_POST['updateCity'],$_POST['updateProv'],$_POST['updatePostal'],$_POST['updateDob'], $_POST['targetCustomer']);
    $updateSql->execute();

 echo "</strong>,&nbsp;record has been updated in records!&nbsp;<a href='read.php'>Click here</a></p>";
}


?>



<script>
    
function myFunction(val) {
  var x = document.getElementById("mySelect").value;
  document.getElementById("demo").innerHTML = "You selected: " + x;
}
</script>

</body>
</html>


