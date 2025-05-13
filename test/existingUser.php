
<?php
include "server/connect.php";


$EID = "";
$ENAME = "";
$EGENDER = "";
$EDOB= "";
$EAGE = "";
$EPHONE = "";
$EADDRESS = "";
$ECOACH = "";
$EDATE = date("Y-m-d");
$STATUS = "";
$result = null; // Initialize $result to null
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $EID = $_POST['EID'];
       if (isset($_POST["load_Data"])) {

    $sql = "EID,	ENAME,	EGENDER,	EDOB,	EAGE,	EPHONE,	EADDRESS,	ECOACH,	EDATE,	STATUS	 from existing_users where EID='$EID'";
            

    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ENAME = $row['ENAME'];
        $EGENDER = $row['EGENDER'];
        $EDOB = $row['EDOB'];
        $EAGE = $row['EAGE'];
        $EPHONE = $row['EPHONE'];
        $EADDRESS = $row['EADDRESS'];
        $ECOACH = $row['ECOACH'];
        $EDATE = $row['EDATE'];
        $STATUS = $row['STATUS'];
    } else {
        echo "<script>alert('No data found for ID: $EID');</script>";
    }
    
    }

    if (isset($_POST["Gold_registration"])) {
       $Height=$_POST['Height'];
          $Weight=$_POST['Weight'];
          $BodyFat=$_POST['BodyFat'];
          $BMI=$_POST['BMI']; 
          $VFA=$_POST['VFA'];
          $BODYAGE=$_POST['BODYAGE'];
          $RM=$_POST['RM'];
          $Chest=$_POST['chest'];
          $Waist=$_POST['waist'];
          $Hip=$_POST['hip'];
          $Date=$_POST['trialDate'];
          $REMARKS=$_POST['remarks'];
          $MEDICATION=$_POST['medications'];

          $sql2=  "INSERT INTO existbody (EID, ENAME, EHEIGHT, EWEIGHT, EBODYFAT, EBMI, EVFA, EBODYAGE, ERM, ECHEST, EWAIST, EHIP, EDate, EMEDICATION, EREMARKS) 
          VALUES ('$EID', '$ENAME', '$Height', '$Weight', '$BodyFat', '$BMI', '$VFA', '$BODYAGE', '$RM', '$Chest', '$Waist', '$Hip', '$Date', '$MEDICATION', '$REMARKS')";

          $conn->query($sql2);

          $TOTALAMOUNT=$_POST['totalAmount'];
          $paymentType=$_POST['paymentType'];
          $AMOUNTPAID=$_POST['amountPaid'];
          $AMOUNTDUE=$_POST['amountDue']; 
            $sql3="INSERT INTO payment ( TOTALAMOUNT, AMOUNTPAID, AMOUNTDUE, MODEOFPAY, DATE, ID, UNAME) 
            VALUES ('$TOTALAMOUNT','$AMOUNTPAID','$AMOUNTDUE','$paymentType','$Date','$Id','$uname')";

            $sql4="INSERT INTO daily (Id, uname, weight, TOTALAMOUNT, amountpaid, amountdue)
            VALUES ('$Id', '$uname', '$Weight', '$TOTALAMOUNT', '$AMOUNTPAID', '$AMOUNTDUE')";

              if ( $conn->query($sql3) === TRUE && $conn->query($sql4) === TRUE) {
              $path=chdir("../");
              echo "<script> window.location.href='../admin.html'</script>";
            } else {
              echo "Error: " . $sql1 ."<br>". $sql2 ."<br>". $sql3 . "<br>" .$sql4. "<br>". $conn->error;
            }
         

    }
    $conn->close();
  }




?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Existing User Registration</title>
  <link rel="stylesheet" href="style/admin.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #e7f5ec;
      padding: 20px;
    }

    header {
        background-color: #0ba29d;
        color: white;
        padding: 20px;
        text-align: center;
      }

      nav {
        background: #eee;
        display: flex;
        justify-content: center;
        padding: 10px 0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
      }

      nav a {
        margin: 0 20px;
        text-decoration: none;
        color: #333;
        font-weight: bold;
        transition: color 0.3s;
      }

      nav a:hover {
        color: #0ba29d;
      }

    h2 {
      color: #2f7a4b;
      border-bottom: 2px solid #2f7a4b;
      padding-bottom: 5px;
      margin-top: 30px;
    }
    .form-grid {
      display: flex;
      gap: 20px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    .form-group {
      flex: 1;
      min-width: 250px;
      position: relative;
    }
    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }
    input, select {
      width: 95%;
      padding: 10px;
      border: 1px solid #2f7a4b;
      border-radius: 5px;
    }
    .focus-indicator {
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 0;
      height: 2px;
      background-color: #2f7a4b;
      transition: width 0.3s;
    }
    input:focus + .focus-indicator,
    select:focus + .focus-indicator {
      width: 100%;
    }
    .buttons {
      margin-top: 30px;
    }
    .btn {
      background-color: #2f7a4b;
      color: white;
      padding: 10px 25px;
      border: none;
      border-radius: 25px;
      font-size: 1em;
      cursor: pointer;
      margin-right: 10px;
    }
    footer {
        background-color: #0ba29d;
        color: white;
        text-align: center;
        padding: 5px;
        position: fixed;
        bottom: 0;
        width: 100%;
      }
  </style>
</head>
<body>

    <header>
        <h1>Healthy and Happy Community</h1>
      </header>
  
      <nav>
        <a href="about.html">About</a>
        <div class="dropdown">
          <a href="#"> Clients</a>
          <div class="dropdown-content">
            <a href="registration.html">New Registration</a>
            <a href="existingUser.html">Gold UMS Registration</a>
            <a href="SearchData.php">Search Profile</a>
            <a href="#">Client Reports</a>
            
          </div>
        
        </div>
        <a href="idealweight.html">Weight Tracker</a>
        <a href="#">Payments</a>
        <a href="#">Settings</a>
        <a href="index.html">Logout</a>
      </nav>

  <form id="existingUserForm" action="existingUser.php" method="POST">

    <!-- Section 1: Personal Info -->
    <h2>Personal Information</h2>
    <div class="form-grid">
      <div class="form-group">
        <label for="Id">Guest ID</label>
        <input type="text" id="Id" class="form-control" name="Id" data-rule-minlength="10" data-rule-maxlength="10" placeholder="05RS25/001" required>
        
        <div class="focus-indicator"></div>
        <button type="submit" class="btn" name="load_Data" value="Load Data">Load Data</button>
      </div>
      
        
      <div class="form-group">
        <label for="uname">Full Name</label>
        <input type="text" id="uname" class="form-control" name="uname" placeholder="Your name" required>
        <div class="focus-indicator"></div>
      </div>
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="gender">Gender</label>
        <input type="text" id="gender" class="form-control" name="gender" readonly>
        <div class="focus-indicator"></div>
      </div>
      <div class="form-group">
        <label for="dob">Date of Birth</label>
        <input type="text" id="dob" class="form-control" name="dob" readonly>
        <div class="focus-indicator"></div>
      </div>
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="age">Age</label>
        <input type="number" id="age" name="age" class="form-control" readonly>
        <div class="focus-indicator"></div>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" class="form-control" placeholder="10 digits only" required>
        <div class="focus-indicator"></div>
      </div>
    </div>
<div class="form-grid">
    <div class="form-group">
      <label for="uaddress">Address</label>
      <input type="text" id="uaddress" name="uaddress" class="form-control" placeholder="Your address" required>
      <div class="focus-indicator"></div>
    </div>
</div>
<div class="form-grid">
    <div class="form-group">
      <label for="coach">Coach</label>
      <input type="text" id="coach" name="coach" class="form-control" placeholder="Coach Name" required>
      <div class="focus-indicator"></div>
    </div>
    <div class="form-group">
      <label for="period">Status</label>
      <input type="text" id="status" name="status" class="form-control" value="Active" readonly>
      <div class="focus-indicator"></div>
    </div>
    <div class="form-group">
      <label for="period">Date</label>
      <input type="text" id="date" name="date" class="form-control" >
      <div class="focus-indicator"></div>
    </div>
</div>


    <!-- Section 2: Body Evaluation -->
    <h2>Body Evaluation</h2>

    <div class="form-grid">
      <div class="form-group">
        <label for="height">Height (cm)</label>
        <input type="number" id="Height" name="Height" class="form-control" >
        <div class="focus-indicator"></div>
      </div>
      <div class="form-group">
        <label for="weight">Weight (kg)</label>
        <input type="number" id="Weight" name="Weight" class="form-control" >
        <div class="focus-indicator"></div>
      </div>
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="bmi">B.M.I.</label>
        <input type="text" id="BMI" name="BMI" class="form-control" >
        <div class="focus-indicator"></div>
      </div>
      <div class="form-group">
        <label for="BodyFat">Body Fat (%)</label>
        <input type="text" id="BodyFat" name="BodyFat" class="form-control" >
        <div class="focus-indicator"></div>
      </div>
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="rm">R.M.</label>
        <input type="text" id="RM" name="RM" class="form-control" >
        <div class="focus-indicator"></div>
      </div>
      <div class="form-group">
        <label for="VFA">V.F.A.</label>
        <input type="number" id="VFA" name="VFA" class="form-control" >
        <div class="focus-indicator"></div>
      </div>
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="bodyAge">Body Age</label>
        <input type="number" id="BODYAGE" name="BODYAGE" class="form-control" >
        <div class="focus-indicator"></div>
      </div>
    <div class="form-group">
        <label for="chest">Chest</label>
        <input type="number" id="chest" name="chest" class="form-control" >
        <div class="focus-indicator"></div>
      </div> 
    </div>
<div class="form-grid">
      <div class="form-group">
        <label for="waist">Waist</label>
        <input type="number" id="waist" name="waist" class="form-control" >
        <div class="focus-indicator"></div>
      </div>
    <div class="form-group">
        <label for="Hip">HIP</label>
        <input type="number" id="hip" name="hip" class="form-control" >
        <div class="focus-indicator"></div>
      </div> 
    </div>
    <div class="form-grid">
       <div class="form-group">
        <label for="remarks">Remarks</label>
        <input type="text" id="remarks" name="remarks" class="form-control" >
        <div class="focus-indicator"></div>
      </div>
      <div class="form-group">
        <label for="medications">Medications (if any)</label>
        <input type="text" id="medications" name="medications" class="form-control" placeholder="List any medications">
        <div class="focus-indicator"></div>
    </div>
</div>
        
    <!-- Section 3: Fee Payment -->
    <h2>Fee Payment</h2>

    <div class="form-grid">
      <div class="form-group">
        <label for="totalAmount">Total Amount</label>
        <input type="text" id="totalAmount" name="totalAmount" class="form-control" value="₹7399" readonly>
        <div class="focus-indicator"></div>
      </div>
      <div class="form-group">
        <label for="paymentType">Payment Type</label>
        <select id="paymentType" name="paymentType" class="form-control" >
          <option value="">Select Payment Type</option>
          <option value="Cash">Cash</option>
          <option value="UPI">UPI</option>
        </select>
        <div class="focus-indicator"></div>
      </div>
    </div>

    <div class="form-grid">
      <div class="form-group">
        <label for="amountPaid">Amount Paid</label>
        <input type="number" id="amountPaid" name="amountPaid" class="form-control"  oninput="updateAmountDue()">
        <div class="focus-indicator"></div>
      </div>
      <div class="form-group">
        <label for="amountDue">Amount Due</label>
        <input type="text" id="amountDue" name="amountDue" class="form-control" value="₹7399" readonly>
        <div class="focus-indicator"></div>
      </div>
    </div>
    <div class="form-grid">
 <div class="buttons">
        <button type="submit" class="btn" name="Gold_registration" value="Gold Registration">Gold Registration</button>
      </div>
</div>
   
  </form>

  <footer>
    &copy; 2025 Healthy and Happy Community
  </footer>

  <script>
    function calculateAge() {
      const dob = new Date(document.getElementById('dob').value);
      if (!isNaN(dob)) {
        const today = new Date();
        let age = today.getFullYear() - dob.getFullYear();
        const m = today.getMonth() - dob.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < dob.getDate())) {
          age--;
        }
        document.getElementById('age').value = age;
      }
    }

    function updateAmountDue() {
      const total = 800;
      const paid = parseFloat(document.getElementById('amountPaid').value) || 0;
      const due = Math.max(0, total - paid);
      document.getElementById('amountDue').value = `₹${due}`;
    }

    
  


  </script>

</body>
</html>