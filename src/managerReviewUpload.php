<?php

// connect to database
$con = mysqli_connect("localhost","rmorga51","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysqli_select_db($con, "accounting");

  //post properties Table: journal_entry
  echo $_POST['transaction_id'];
$transaction_id = $_POST['transaction_id'];

if(isset($_POST['approve']))
{
  $sql=("UPDATE journal_entry SET approval_status = 'approved' WHERE transaction_id = $transaction_id"); 
  $sqlJoin = ("SELECT *
  FROM journal_entry
  INNER JOIN je_accounts ON journal_entry.transaction_id = je_accounts.transaction_id
  WHERE transaction_id = $transaction_id");
   if (!mysqli_query($con, $sql))
   {
   die('Error: ' . mysqli_error($con));
   }
  }
  else{
    $sql=("UPDATE journal_entry SET approval_status = 'rejected' WHERE transaction_id = $transaction_id"); 
  
    if (!mysqli_query($con, $sql))
    {
    die('Error: ' . mysqli_error($con));
    }
  }
  header("Location:ManagerReview.php");
  exit; 
?>