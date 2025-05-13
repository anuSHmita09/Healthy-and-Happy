<?php
// Database credentials
include "connect.php";


  




 //switch ($_POST['submit']) {
    //    case 'personalinfo':
          $Id = $_POST['Id'];
          $uname = trim($_POST['uname']);    
          $gender = $_POST['gender'];
          $dob = $_POST['dob'];
          $age = $_POST['age'];
          $phone = $_POST['phone'];
          $uaddress = $_POST['uaddress'];
          $coach = $_POST['coach'];
          $trialDate = $_POST['trialDate'];
          $goldums = $_POST['goldums'];
          $status="Trial";
           $sql1 = "INSERT INTO registration (Id, uname, gender , dob, age, phone, uaddress, coach, trialDate, goldums, status) 
           VALUES ('$Id', '$uname', '$gender', '$dob', '$age', '$phone', '$uaddress', '$coach', '$trialDate', '$goldums', '$status')"; 
            //if ($conn->query($sql) === TRUE) {
              //echo "Registration successful!";
            //} else {
              //echo "Error: " . $sql . "<br>" . $conn->error;
            //}
      //                  break;

        //case 'bodyeval':
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

          $sql2=  "INSERT INTO bodyeval (Id, UNAME, HEIGHT, WEIGHT, BODYFAT, BMI, VFA, BODYAGE, RM, CHEST, WAIST, HIP, Date, MEDICATION, REMARKS)
          VALUES ('$Id', '$uname', '$Height', '$Weight', '$BodyFat', '$BMI', '$VFA', '$BODYAGE', '$RM', '$Chest', '$Waist', '$Hip', '$Date', '$MEDICATION', '$REMARKS')";
          ;
         //   if ($conn->query($sql1) === TRUE) {
           //   echo "Registration successful!";
           // } else {
             // echo "Error: " . $sql . "<br>" . $conn->error;
            //}
          //  break;
        //case 'payment':
          $TOTALAMOUNT=$_POST['totalAmount'];
          $paymentType=$_POST['paymentType'];
          $AMOUNTPAID=$_POST['amountPaid'];
          $AMOUNTDUE=$_POST['amountDue'];
            $sql3="INSERT INTO payment ( TOTALAMOUNT, AMOUNTPAID, AMOUNTDUE, MODEOFPAY, DATE, ID, UNAME, STATUS)
            VALUES ('$TOTALAMOUNT','$AMOUNTPAID','$AMOUNTDUE','$paymentType','$Date','$Id','$uname','$status')";

            $sql4="INSERT INTO daily (Id, uname, weight, TOTALAMOUNT, amountpaid, amountdue,status)
             VALUES ('$Id', '$uname', '$Weight', '$TOTALAMOUNT', '$AMOUNTPAID', '$AMOUNTDUE','$status')";

              if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3) === TRUE && $conn->query($sql4) === TRUE) {
              $path=chdir("../");
              echo "<script> window.location.href='../admin.html'</script>";
            } else {
              echo "Error: " . $sql1 ."<br>". $sql2 ."<br>". $sql3 . "<br>" .$sql4. "<br>". $conn->error;
            }
         

    
//}



$conn->close();
?>
