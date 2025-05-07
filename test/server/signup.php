<?php
include 'connect.php';

if(empty($_POST['signup-id']) || empty($_POST['signup-name']) || empty($_POST['signup-password']) || empty($_POST['confirm-password'])) {
    echo "Please fill in all fields.";
    exit;
}
$adminId = $_POST['signup-id'];
$adminName = $_POST['signup-name'];
$password = $_POST['signup-password'];// password_hash($_POST['signup-password'], PASSWORD_DEFAULT); // Hashing the password
$confirmPassword = $_POST['confirm-password'];// password_hash($_POST['confirm-password'], PASSWORD_DEFAULT); // Hashing the password
if ($password !== $confirmPassword) {
    echo "Passwords do not match.";
    exit;
} 
// Insert data into the database
$sql = "INSERT INTO `admin` (adminId, adminName, password) VALUES ('$adminId', '$adminName', '$password')";


if ($conn->query($sql) === TRUE) {
  header("Location:http://localhost/main/c/test/index.html"); // Redirect to login page after successful registration
  exit();
} else {
  echo "Error: " . $sql . "<br>" .  $conn->error;
}
?>
