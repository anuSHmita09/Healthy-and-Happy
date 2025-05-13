<?php
include 'connect.php';

session_start();
error_reporting(E_ALL);

if(empty($_POST['signin-id']) || empty($_POST['signin-password'])) {
    echo "Please fill in all fields.";
    exit;
}
 $adminId=$_POST['signin-id'];
$password=$_POST['signin-password'];
$sql="select adminName from admin where adminId='$adminId' AND password='$password'";
$result = $conn->query($sql);
$_SESSION['adminName'] = $adminId;
if ($result->num_rows > 0) {
    // Authentication successful
    $row = $result->fetch_assoc() ;
        
        
      
    header("Location: http://localhost/main/c/test/admin.html");
     $_SESSION['adminName'] = $row["adminName"];
    exit();
} else {
    // Authentication failed

    echo "<script>alert('Invalid Credentials.');</script>";
    header("Location: http://localhost/main/c/test/server/signin.php");
}

$conn->close();
?>