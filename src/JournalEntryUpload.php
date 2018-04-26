<?php
////////////Code for Log Page////////////////////////////
session_start();
$username = $_SESSION['username']; // store session username
$logActivity = 'Journal entry with REF# '.$_SESSION['transaction_id'] .' was submitted for manager approval.';
// connect to database
$con = mysqli_connect("localhost","rmorga51","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error($con));
  }
  mysqli_select_db($con, "accounting");
////////insert data into log_page//////////
$userTypeQuery = $con->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
$currentDate = date("Y/m/d h:i:s"); 
while($row = $userTypeQuery->fetch_assoc()){
    $userType = $row['user_type'];
}
$logUpdate = "INSERT INTO log_page (username, usertype, activity, date)
VALUES ('$username', '$userType', '$logActivity', '$currentDate')";
if (!mysqli_query($con, $logUpdate))
  {
  die('Error: ' . mysqli_error($con));
  }
else{  
    echo "Submit was successful";
}
/////////////////////////////////////////// 


 
  $transaction_id = ($_POST["transaction_id"]);
  $description = ($_POST["description1"]);
  $date = ($_POST["date1"]);

  $name = ($_POST["account_name"]);
  $debit = ($_POST["debit"]);
  $credit = ($_POST["credit"]);
//post properties Table: journal_entry 
$sql="INSERT INTO journal_entry (user_id, manager_id, description1, approval_status, date1)
VALUES 
    ('Developer',
    'Developer',  
    '$description',
    'Pending',
    '$date'
    )";
   
     if (!mysqli_query($con, $sql))
 {
 die('Error: ' . mysqli_error($con));
 }
//post properties Table: je_accounts

 for ($i=1; $i <count($name); $i++){
 $sql2="INSERT INTO je_accounts (transaction_id, account_name, debit, credit)
 VALUES 
     ('$transaction_id',
     '$name[$i]',
     '$debit[$i]',
     '$credit[$i]'
     )";
    
      if (!mysqli_query($con, $sql2))
  {
  die('Error: ' . mysqli_error($con));
  }
 
 }
 

  header("Location:COA.php");
exit;


// my original script ends above

// Display things to the page so you can see what is happening for testing purposes
/*echo "The file named <strong>$fileName</strong> uploaded successfuly.<br /><br />";
echo "It is <strong>$fileSize</strong> bytes in size.<br /><br />";
echo "It is an <strong>$fileType</strong> type of file.<br /><br />";
echo "The file extension is <strong>$fileExt</strong><br /><br />";
echo "The Error Message output for this upload is: $fileErrorMsg";*/
//mysql_close($con);
?>
