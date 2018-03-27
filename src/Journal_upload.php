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
$sql="INSERT INTO journal_entry (user_id, manager_id, description1, approval_status, date1)
VALUES
(Developer, Developer,'$_POST[description1]', n\a,'$_POST[date1]')";

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