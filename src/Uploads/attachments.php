<?php
// correct syntax for storing file path
$fileName = $_FILES["uploaded_file"]["name"]; // The file name
$uploadDir = 'uploads'; //upload directory
$filePath = $uploadDir . $fileName; // file path/completed directory
// connect to database
$con = mysqli_connect("localhost","rmorga51","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  mysqli_select_db($con, "rmorga51");

  //post properties
$sql="INSERT INTO test (Link, Image_directory, Description, Subject)
VALUES
('$filePath)";

if (!mysqli_query($con, $sql))
  {
  die('Error: ' . mysqli_error($con));
  }
echo "Submit was successful";
?>