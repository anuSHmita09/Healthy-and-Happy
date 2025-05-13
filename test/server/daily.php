<?php
include "connect.php";

$status = "Active";
$Id = "";
$UName = "";
$weight = "";
$TOTALAMOUNT = "";
$amountpaid = "";
$amountdue = "";
$Date = "";

$result = null; // Initialize $result to null
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Id = $_POST['Id'];
    $Date = $_POST['Date'];
    $amountpaid = $_POST['amountpaid'];
    if (isset($_POST["load_Data"])) {

    $sql = "SELECT id, uname, weight, TOTALAMOUNT, amountpaid, amountdue from daily where Id='$Id'";
            //FROM registration g
            //JOIN bodyeval b ON g.Id = b.Id
            //JOIN payment p ON g.Id = p.Id
            //WHERE g.Id = '$Id'";

    $result = $conn->query($sql);    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UName = $row['uname'];
        $weight = $row['weight'];
        $TOTALAMOUNT = $row['TOTALAMOUNT'];
        $amountpaid = $row['amountpaid'];
        $amountdue = $row['amountdue'];
    } else {
        echo "<script>alert('No data found for ID: $Id');</script>";
    }
    
    }
    //table creation in html
    if (isset($_POST["update_data"])) {
        $Id = $_POST['Id'];
        $Date = $_POST['Date'];
        $UName = $_POST['uname'];
        $weight = $_POST['weight'];
        $TOTALAMOUNT = $_POST['TOTALAMOUNT'];
        $amtpaid = $_POST['amountpaid'];
        $amountdue = $_POST['amountdue'];
        if(floatval($TOTALAMOUNT) <= floatval($amtpaid) + floatval($amountpaid)) {
    $amtpaid = floatval($amtpaid) + floatval($amountpaid);
    $amountdue = floatval($TOTALAMOUNT) - floatval($amtpaid);
}
        $sql2 = "INSERT INTO `daily`(`id`, `cur_date`, `uname`, `weight`, `TOTALAMOUNT`, `amountpaid`, `amountdue`, `status`) 
           VALUES ('$Id', '$Date', '$UName', '$weight', '$TOTALAMOUNT', '$amtpaid', '$amountdue', '$status')";
           
              
                  if ($conn->query($sql2) === TRUE) {
        echo "<script>alert('Data updated successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $sql2 . "<br>" . $conn->error . "');</script>";
    }
    
    }
  
    if (isset($_POST["view_data"])) {   
        $Id = $_POST['Id'];


    $sql3 = "SELECT id, cur_date, uname, weight, TOTALAMOUNT, amountpaid, amountdue, STATUS from daily where id='$Id'";
   $result = mysqli_query($conn, $sql3);
   
    }
   
//$sql = "CALL UpdateexistPerson()";
//$result = $conn->query($sql);
//if ($result === false) {
  //  die("Error executing query: " . $conn->error);
//}
// If the stored procedure returns a result set (e.g., the SELECT statement within the loop), you can process it here
//if ($result->num_rows > 0) {
  //  while($row = $result->fetch_assoc()) {
    //    echo $row["uid"];
    //}
 // }


}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Daily Entry</title>

  <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #0e100f;
    color: #e6ffe6;
    margin: 0;
    padding: 20px;
  }

  form {
    max-width: 800px;
    margin: 0 auto;
    background-color: #102d14;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 128, 0, 0.3);
  }

  label {
    display: inline-block;
    width: 160px;
    margin-bottom: 10px;
    font-weight: bold;
    color: #b9ffb9;
  }

  input[type="text"],
  input[type="date"] {
    padding: 10px;
    border: 1px solid #50b550;
    border-radius: 6px;
    width: 200px;
    background-color: #1a331a;
    color: #d6ffd6;
    margin-bottom: 15px;
  }

  input[type="submit"] {
    padding: 10px 20px;
    background-color: #28a745;
    color: white;
    font-weight: bold;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s ease;
  }

  input[type="submit"]:hover {
    background-color: #218838;
  }

  table {
    width: 100%;
    margin-top: 30px;
    border-collapse: collapse;
    background-color: #153c1a;
    border-radius: 10px;
    overflow: hidden;
    color: #e0ffe0;
  }

  th, td {
    padding: 12px;
    text-align: center;
    border: 1px solid #2e6b2e;
  }

  th {
    background-color: #28a745;
    color: white;
  }

  tr:nth-child(even) {
    background-color: #1f3c1f;
  }

  tr:hover {
    background-color: #264d26;
  }

  .table-header {
    font-weight: bold;
  }
</style>

</head>
<body>
<form id="frm" action="Daily.php" method="post">
  <label for="Date">Date:</label>
  <input type="date" id="Date" name="Date" value="<?php echo htmlspecialchars($Date); ?>"><br><br>

  <label for="Id">Member Id:</label>
  <input type="text" id="Id" name="Id" value="<?php echo htmlspecialchars($Id); ?>" > &nbsp; &nbsp;
  <input type="submit" name="load_Data" value="Load Data"><br><br>
  <label for="uname">Member Name:</label>
  <input type="text" id="uname" name="uname" value="<?php echo htmlspecialchars($UName); ?>" ><br><br>

  <label for="Weight">Weight:</label>
  <input type="text" id="weight" name="weight" value="<?php echo htmlspecialchars($weight); ?>" ><br><br>

  <label for="TotalAmount">Total Amount:</label>
  <input type="text" id="TOTALAMOUNT" name="TOTALAMOUNT" value="<?php echo htmlspecialchars($TOTALAMOUNT); ?>"><br><br>

  <label for="AmountPaid">Amount Paid:</label>
  <input type="text" id="amountpaid" name="amountpaid" oninput="updateAmountDue()" value="<?php echo htmlspecialchars($amountpaid); ?>" ><br><br>

  <label for="AmountDue">Amount Due:</label>
  <input type="text" id="amountdue" name="amountdue" value="<?php echo htmlspecialchars($amountdue); ?>" ><br><br>
  <input type="submit" value="update_data" name="update_data"> &nbsp; &nbsp;
    <input type="submit" name="view_data" value="View Data"><br><br>
 <table >
                        <tr class="table-header">
                        <th>ID</th>
                        <th>Date</th>
                        <th>Name</th>
                        <th>Weight</th>
                        <th>Total Amount</th>
                        <th>Amount Paid</th>
                        <th>Amount Due</th>

                    </tr>
                
                <?php
                if ($result && mysqli_num_rows(result: $result) > 0)   {
                      echo "<script>showTable();</script>";
                        while ($row = mysqli_fetch_assoc(result: $result)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['cur_date'] . "</td>";
                            echo "<td>" . $row['uname'] . "</td>";
                            echo "<td>" . $row['weight'] . "</td>";
                            echo "<td>" . $row['TOTALAMOUNT'] . "</td>";
                            echo "<td>" . $row['amountpaid'] . "</td>";
                            echo "<td>" . $row['amountdue'] . "</td>";
                            echo "</tr>";
                        }
                    }
                
                    ?>
                
                </table>
</form>
<script>

function updateAmountDue() {
    const total = parseFloat(document.getElementById('TOTALAMOUNT').value) || 0;
    const paid = parseFloat(document.getElementById('amountpaid').value) || 0;
    const due = Math.max(0, total - paid);
    document.getElementById('amountdue').value = due.toFixed(2);
}

function validateForm() {
    const id = document.getElementById('Id').value.trim();
    const date = document.getElementById('Date').value;
    const amount = document.getElementById('amountpaid').value;
    
    if (!id) {
        alert('Please enter Member ID');
        return false;
    }
    
    if (!date) {
        alert('Please select a date');
        return false;
    }
    
    if (amount && isNaN(parseFloat(amount))) {
        alert('Amount must be a valid number');
        return false;
    }
    
    return true;
}


</script>

</body>
</html>
