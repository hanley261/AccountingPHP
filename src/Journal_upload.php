<?php

// connect to database
$con = mysqli_connect("localhost","rmorga51","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysqli_select_db($con, "accounting");
  
$currentDate = date("m/d/Y"); 
//post properties
$sql="INSERT INTO accounts (account_code, account_type, account_subtype, account_name, normal_side, account_status, initial_balance, last_date_accessed, last_user_id_accessed)
VALUES
('$_POST[account_code]','$_POST[account_type]','$_POST[account_subtype]','$_POST[account_name]','$_POST[normal_side]','$_POST[account_status]','$_POST[initial_balance]','$currentDate','$_POST[last_user_id_accessed]' )";

if (!mysqli_query($con, $sql))
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