<?php

// connect to database
$con = mysqli_connect("localhost","rmorga51","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysqli_select_db($con, "accounting");


  $name = ($_POST["account_name"]);
  $reference = ($_POST["reference"]);
  $debit = ($_POST["debit"]);
  $credit = ($_POST["credit"]);
  $description = ($_POST["description"]);
  $date = ($_POST["date"]);
 

//post properties

 for ($i=1; $i <count($name); $i++){
 $sql="INSERT INTO journalentry (account_name, reference, debt, credit, description1, date1)
 VALUES 
     ('$name[$i]',
     '$reference[$i]',
     '$debit[$i]',
     '$credit[$i]',
     '$description[$i]',
      '$date[$i]')";
    
      if (!mysqli_query($con, $sql))
  {
  die('Error: ' . mysqli_error($con));
  }
 
 }
 

  header("Location:home.php");
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
