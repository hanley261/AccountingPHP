<?php

// connect to database
$config['db'] = array(
	'host'			=>'localhost',
	'username'		=>'rmorga51',
	'password'		=>'',
	'dbname'		=>'accounting'
);
	

$db = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password']); 
$db->setATTRIBUTE(PDO::ATTR_EMULATE_PREPARES, false);
$db->setATTRIBUTE(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$con = mysqli_connect("localhost","rmorga51","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysqli_select_db($con, "accounting");

  //post properties Table: journal_entry
$transaction_id = $_POST['transaction_id'];

if(isset($_POST['approve']))
{
  $total = 0;
  $query = $db->query("SELECT * FROM chart_of_accounts WHERE account_status != 'n/a'");
  $sql=("UPDATE journal_entry SET approval_status = 'approved' WHERE transaction_id = $transaction_id"); 
  while($coa = $query->fetch(PDO::FETCH_ASSOC)){
    $name = $coa['account_name'];
    $total = 0;
    $query2 = $db->query("SELECT * FROM journal_entry INNER JOIN je_accounts ON journal_entry.transaction_id = je_accounts.transaction_id WHERE account_name =
    '$name' AND journal_entry.transaction_id = $transaction_id ORDER BY debit Desc");
    while($row = $query2->fetch(PDO::FETCH_ASSOC)){
        $total += $row['debit'];
        $total -= $row['credit'];

    }
 
    $updateBalance=("UPDATE chart_of_accounts SET balance = balance + $total WHERE account_name = '$name'");
    if (!mysqli_query($con, $updateBalance))
    {
    die('Error: ' . mysqli_error($con));
    }

  }
   if (!mysqli_query($con, $sql))
   {
   die('Error: ' . mysqli_error($db));
   }
  }
  else{
    $sql=("UPDATE journal_entry SET approval_status = 'rejected' WHERE transaction_id = $transaction_id"); 
  
    if (!mysqli_query($con, $sql))
    {
    die('Error: ' . mysqli_error($db));
    }
  }
  header("Location:ManagerReview.php");
  exit; 
?>