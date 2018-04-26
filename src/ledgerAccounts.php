<?php
// Initialize the session
session_start();
 $username = $_SESSION['username'];
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<!doctype html>
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

if(isset  ($_GET['Subject'])){
  $order = $_GET['Subject'];
  $queryFilter = $db->prepare("SELECT * FROM chart_of_accounts
   WHERE account_status != 'n/a' AND balance != 0 
   ORDER BY '$order' ASC");
}
else{
  $queryFilter = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_status != 'n/a' AND balance != 0 ORDER BY 'account_name' ASC");
}

$queryFilter->execute();

$query = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_status != 'n/a'");

$query->execute();
?>
<html lang = en>
    <head>
                <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <!-- CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <link rel="stylesheet" href="css/COA.css"/>
            <link rel="stylesheet" href="css/header.css"/>
            <link rel="stylesheet" href="css/ledgerAccounts.css"/>
                <!---Title -->
            <title>AnyWhere-Chart Of Accounts</title>
    </head>
    <body>

        
              <!-- Header-->


                      <nav class="navbar navbar-expand navbar-primary">
                <header class="navbar-brand" href="./home.html"><img src="assets/logo.png" alt="bluePrint" height="60"/></header>
                
                <span class="navbar-toggler-icon"></span>
              </button>
            
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item active">
                    <a class="nav-link active" href="./home.php">Home<span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link"href="./COA.php">Charts of Account</a>
                  </li>
                  <?php // to hide 'manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./JournalEntry.php">Journal Entry</a>
                </li>';	
				}
				?>
				
				<?php // to hide 'manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the manager review link*/
				if($userType == 'Manger'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./ManagerReview.php">Manager Review</a>
                </li>';	
				}
				?>
                  <?php // to hide 'manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./ledgerAccounts.php">Accounts Ledgers</a>
                </li>';	
				}
				?>
                  <?php // to hide 'manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./accounts.php">Accounts</a>
                </li>';	
				}
				?>
                  <?php // to hide 'manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./FinancialStatements.php">Financial Statements</a>
                </li>';	
				}
				?>
                  <?php // to hide 'manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./logs.php">logs</a>
                </li>';	
				}
				?>
      
      
                </ul>
                
              </div>
              <div class="pull-right">
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="navbarDropdown" href="./logout.php"><span class="glyphicon glyphicon-user"></span> <?php echo htmlspecialchars($_SESSION['username']); ?></a>
                  </li>
                  <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="navbarDropdown" href="./help.php"><span class="glyphicon glyphicon-question-sign"></span> Help</a>
                  </li>
                </ul>
              </div>
            </nav>





            <legend class="" align="center" text-size=""><strong>Accounts</strong></legend>
            <!-- Search Component -->
            <div class="space"> </div>
                   <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-4">
                                    <div class="form-group has-feedback">
                                        
                                                <input type="text" class="form-control" name="search" id="search" placeholder="search"/>
                                                <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                          
                                    </div>                                
                            </div>
                        </div>
                    </div>
                    <form method="get" action="ledgerAccounts.php" class ="form-inline"> 
                    <select  name="Subject" class ="form-control">
                    <?php 
                      while($filter = $queryFilter->fetch(PDO::FETCH_ASSOC)){
                          echo "<option value =",$filter['account_name'],">",$filter['account_name'],"</option>";
                      }
                    ?>
                    </select>
                    <input class = "btn btn-success float-right" align = "right" type="submit" value="Filter">
                    </form>
<!--Body of ledger accoutns -->
<div id = "table-container">
<?php
 while($coa = $query->fetch(PDO::FETCH_ASSOC)){
           /*Account Name */
           echo '<div class = "show1">';
           echo '<legend class="" align="center" text-size=""><strong><p class = "table-title">', $coa['account_name'],'</p></strong></legend>';
echo '<table class= "table">';
        /*Header for table */
        echo '<tr class = "table-header-row"><th>Date</th><th>Debit</th><th>Credit</th></tr>';
        echo '<tbody>';
        $accountName = $coa['account_name'];
        $query2 = $db->query("SELECT * FROM journal_entry INNER JOIN je_accounts ON journal_entry.transaction_id = je_accounts.transaction_id WHERE account_name =
         '$accountName' AND approval_status = 'approved' ORDER BY debit DESC");
        
        while($row = $query2->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
        echo '<td><a href="./transactions.php?Subject=',$row['transaction_id'],'">',$row['date1'],'</a></td>';
        echo '<td><a href="./transactions.php?Subject=',$row['transaction_id'],'"><span class = "table-debit">',$row['debit'],'</span></a></td>';
        echo '<td><a href="./transactions.php?Subject=',$row['transaction_id'],'"><span class = "table-credit">',$row['credit'],'</span></a></td>';
        echo '<td></tr>';
        }
              
        if($coa['balance'] > 0){
          echo '<tr><td>End Bal</td>';
          echo "<td class = 'totalDebits'>",$coa['balance'],"</td><td></td></tr>";
        }
        elseif($coa['balance'] < 0){
          echo '<tr><td>End Bal</td>';
          echo "<td></td><td class='totalCredits'><div class='overline'>",$coa['balance'],"</div></td></tr>";
        }
        echo  '</tbody></table>';
        echo '</div>';
 }
?>
</div>
<div id="filterWord"class="hide"><?php
  if(isset  ($_GET['Subject'])){
  echo $_GET['Subject'];
   }
  ?>
</div>

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="./scripts/ledgerAccounts.js" type="text/javascript"></script>
    </body>
</html> 