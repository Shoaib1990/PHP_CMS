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

    if(!$result = mysqli_query($connection, $sql)) {
        exit(mysqli_error($connection));
    }

    $users = array();
    if(mysqli_num_rows($result)>0) {
        while($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=Users.csv');
    $output = fopen('php://output', 'w');
    fputcsv($output, array('firstName', 'lastName', 'phone', 'email', 'stAddress', 'city', 'province', 'postalCode', 'dateOfBirth', 'id'));

    if(count($users)>0) {
        foreach($users as $row) {
            fputcsv($output, $row);
        }
    }
?>

