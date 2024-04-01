<?php

// create the connection with the database
// 4 :

$dbHost = 'localhost';
$dbUsername = 'root';
$dbpassword = '';
$dbName = 'georgianilacstudents';

// create the database connection

$conn = new mysqli($dbHost, $dbUsername,$dbpassword,$dbName);

//  verification:
// verify that the connection  is built

if ( $conn -> connect_error){

    die("Connection failed" . $conn -> connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO studentsILAC (name,password) VALUES('$name', '$password')";
    // check that sql is executed

    if ($conn ->query($sql) === TRUE){
        // Handle success
        echo "Record inserted successfully";
    } else {
        // Handle failure
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>
