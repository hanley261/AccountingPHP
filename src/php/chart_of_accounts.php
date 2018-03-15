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


$query = $db->query("SELECT * FROM chart_of_accounts WHERE account_status = 'n/a'");

?>
<html>
<head><style>
	
</style>
</head>
	<body>
	<table class="table table-stripped">
	
		<tr><th>Account Code</th><th>Account Type</th><th>Account Subtype</th><th>Account Name</th><th>Normal Side</th><th>Account Status</th><th>Balance</th><th>Last Date Accessed</th><th>Last User Id Accessed</th></tr>
		<?php
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
				echo "<td>",$row['account_name'],"</td>";
				echo "</tr>";
			}
		?>
	</table>
	</body>
</html>

<!--echo "<tr>";
				echo "<td>",$row['account_code'],"</td>";
				echo "<td>",$row['account_type'],"</td>";
				echo "<td>",$row['account_subtype'],"</td>";
				echo "<td>",$row['account_name'],"</td>";
				echo "<td>",$row['normal_side'],"</td>";
				echo "<td>",$row['account_status'],"</td>";
				echo "<td>",$row['balance'],"</td>";
				echo "<td>",$row['last_date_accessed'],"</td>";
				echo "<td>",$row['last_user_id_accessed'],"</td>";
				echo "</tr>";
		-->