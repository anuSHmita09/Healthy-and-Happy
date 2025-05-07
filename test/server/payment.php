<?php
include "connect.php";

$dateFilter = date("Y-m-d"); 
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dateFilter = $_POST['Date'];

    $sql = "SELECT id, date, uname, MODEOFPAY, amountpaid, amountdue 
            FROM PAYMENT 
            WHERE date = '$dateFilter' 
            ORDER BY id ASC";
    $result = $conn->query($sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment Records</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #0e100f;
      color: #e6ffe6;
      padding: 20px;
    }

    form {
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      margin-right: 10px;
      color: #b9ffb9;
    }

    input[type="date"] {
      padding: 10px;
      border: 1px solid #50b550;
      border-radius: 6px;
      background-color: #1a331a;
      color: #d6ffd6;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color: #28a745;
      color: white;
      font-weight: bold;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      margin-left: 10px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #153c1a;
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
  </style>
</head>
<body>

<h2>Payment Records by Date</h2>

<form method="post" action="">
  <label for="Date">Select Date:</label>
  <input type="date" id="Date" name="Date" value="<?php echo htmlspecialchars($dateFilter); ?>">
  <input type="submit" value="View Data">
</form>

<?php if ($result && $result->num_rows > 0): ?>
<table>
  <tr>
    <th>ID</th>
    <th>Date</th>
    <th>Name</th>
    <th>Mode of Pay</th>
    <th>Amount Paid</th>
    <th>Amount Due</th>
  </tr>
  <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?php echo htmlspecialchars($row['id']); ?></td>
    <td><?php echo htmlspecialchars($row['date']); ?></td>
    <td><?php echo htmlspecialchars($row['uname']); ?></td>
    <td><?php echo htmlspecialchars($row['MODEOFPAY']); ?></td>
    <td><?php echo htmlspecialchars($row['amountpaid']); ?></td>
    <td><?php echo htmlspecialchars($row['amountdue']); ?></td>
  </tr>
  <?php endwhile; ?>
</table>
<?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
  <p>No records found for <?php echo htmlspecialchars($dateFilter); ?>.</p>
<?php endif; ?>

</body>
</html>
