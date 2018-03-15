<?php
$config['db'] = array(
	'host'			=>'localhost',
	'username'		=>'rmorga51',
	'password'		=>'',
	'dbname'		=>'accounting'
);
	

$db = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password']); 
$db->setATTRIBUTE(PDO::ATTR_EMULATE_PREPARES, false);
$db->setATTRIBUTE(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


$query = $db->query("SELECT * FROM journalentry");

?>
<html>
<head><style>
	
</style>
</head>
	<body>
	<table class="table table-stripped">
	
		<tr><th>Account Name</th><th>Reference</th><th>Debit</th><th>Credit</th></tr>
		<?php
		$count = $db->query("SELECT count(*) FROM journalentry");
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
				echo "<td>",$row['ccountName"'],"</td>";
				echo "<td>",$row['debt'],"</td>";
				echo "<td>",$row['credit'],"</td>";
				echo "<td>",$row['reference'],"</td>";
				
				//echo "", $count;
				echo "</tr>";
			}
		?>
	</table>
	</body>
</html> 