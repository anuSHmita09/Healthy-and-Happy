<?php 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "handh";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM registration";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["fi"];
  }
} else {
  echo "0 results";
}
$conn->close();
?>
<iframe width="560" height="315" src="https://www.youtube.com/embed/JMixINP26vg?si=sfunKKaoqVs8Tlgg" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>