<?php
// Database credentials
$host = "localhost";
$user = "root";
$password = "";
$database = "handh";

$conn = new mysqli($host, $user, $password, $database);
////$sql = "CREATE DATABASE If NOT EXISTS handhi";

//if ($conn->query($sql) === TRUE) {
 // $database = "handhi";
 // $conn = new mysqli($host, $user, $password, $database);
//} else {
 // $conn = new mysqli($host, $user, $password, $database);
//}
// Create connection
// $conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
     
    
?>
