<?php

// connect to database
$con = mysqli_connect("localhost","rmorga51","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysqli_select_db($con, "accounting");
  $accountName = ($_POST["account_name"]);
$currentDate = date("m/d/Y"); 
$balance = ($_POST['balance']);
//post properties

$sql="UPDATE chart_of_accounts SET account_status = '$_POST[account_status]' WHERE account_name = '$accountName'";

$sql2="UPDATE chart_of_accounts SET last_date_accessed = ('$currentDate') WHERE account_name = '$accountName'";

$sql3="UPDATE chart_of_accounts SET balance = $balance WHERE account_name = '$accountName'";
if (!mysqli_query($con, $sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "Submit was successful";

if (!mysqli_query($con, $sql2))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "Submit was successful";

if (!mysqli_query($con, $sql3))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "Submit was successful";
// my original script ends above



// Display things to the page so you can see what is happening for testing purposes
/*echo "The file named <strong>$fileName</strong> uploaded successfuly.<br /><br />";
echo "It is <strong>$fileSize</strong> bytes in size.<br /><br />";
echo "It is an <strong>$fileType</strong> type of file.<br /><br />";
echo "The file extension is <strong>$fileExt</strong><br /><br />";
echo "The Error Message output for this upload is: $fileErrorMsg";*/
//mysql_close($con);
?>