<?php

include "connect.php";

if (isset($_POST['search'])) {
  $searchTerm = $_POST['search'];
  
$column = $_POST['column'];
}
  // Check connection
   // Prepare the SQL query
  $sql = "SELECT * FROM bodyeval WHERE $column LIKE '%" . $searchTerm . "%'";

  // Execute the query
  $result = $conn->query($sql);

  // Check if the query returned any results
  if ($result->num_rows > 0) {
    // Output data of each row
    echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Name</th></tr>";
    while($row = $result->fetch_assoc()) {
      echo "<tr><td>" . $row["ID"] . "</td><td>" . $row["NAME"] . "</td></tr>"; 
     }
        echo "</table>";
  } else {
    echo "0 results";
  }

  // Close the connection
  $conn->close();


?>