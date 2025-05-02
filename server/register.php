<?php 
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "HANDH";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully<br>";

$sql = "select * from BODYEVAL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    echo "id: " . $row["ID"] . " | name: " . $row["NAME"] . "<br>";
  }
} else {
  echo "No results found.";
}

$conn->close();
?>
