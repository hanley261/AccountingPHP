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

//Trial Balance
$queryLeft = $db->prepare("SELECT * FROM chart_of_accounts WHERE normal_side = 'Left' AND balance > 0 ORDER BY account_code ASC");
$queryLeftNeg = $db->prepare("SELECT * FROM chart_of_accounts WHERE normal_side = 'Left' AND balance < 0 ORDER BY account_code ASC");
$queryRight = $db->prepare("SELECT * FROM chart_of_accounts WHERE normal_side = 'Right' AND balance < 0 ORDER BY account_code ASC");
$queryRightPos = $db->prepare("SELECT * FROM chart_of_accounts WHERE normal_side = 'Right' AND balance > 0 ORDER BY account_code ASC");

$queryLeft->execute();
$queryLeftNeg->execute();

$queryRight->execute();
$queryRightPos->execute();

//Income Statment
$queryRevenue = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_type = 'Revenue' AND balance != 0 ORDER BY account_code ASC");
$queryExpenses = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_type = 'Operating Expense' AND balance != 0 ORDER BY account_code ASC");

$queryRevenue->execute();

$queryExpenses->execute();

//Balance Sheet

$queryLTA = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_subtype = 'Long Term Asset' AND balance != 0 ORDER BY account_code ASC");
$queryCA = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_subtype = 'Current Asset' AND balance != 0 ORDER BY account_code ASC");
$queryOE = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_type = 'Equity' AND balance != 0 ORDER BY account_code ASC");
$queryLTL = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_subtype = 'Long Term Liability' AND balance != 0 ORDER BY account_code ASC");
$queryCL = $db->prepare("SELECT * FROM chart_of_accounts WHERE account_subtype = 'Current Liability' AND balance != 0 ORDER BY account_code ASC");


$queryLTA->execute();
$queryCA->execute();
$queryOE->execute();
$queryLTL->execute();
$queryCL->execute();

//retained earnings not this year
$queryREPrevious = $db->prepare("SELECT SUM(debit) AS sumd, SUM(credit) AS sumc 
                        from je_accounts
                        INNER JOIN journal_entry ON je_accounts.transaction_id = journal_entry.transaction_id
                        WHERE journal_entry.approval_status = 'approved' 
                        AND journal_entry.date1 NOT LIKE '%2018'");
$queryREPrevious->execute();

$queryDiv = $db->prepare("SELECT * from chart_of_accounts WHERE account_name = 'dividend'" );
$queryDiv->execute();

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
            <link rel="stylesheet" href="css/FinancialStatements.css"/>
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



</div>
        <h1 class="title">Financial Statements</h1>
        <div id="change-sheet">
          <button id ="trial-balance" type="button" class="btn btn-success">Trial Balance</button>
          <button id ="income-statement"type="button" class="btn btn-success">Income Statement</button>
          <button id = "balance-sheet" type="button" class="btn btn-success">Balance Sheet</button>
          <button id = "retained-earnings" type="button" class="btn btn-success">Statement Of Retained Earnings</button>
        </div>
        <div id = "trial-balance-sheet" class="show">
        <div class="table-title">
          <h4>Addams and Family Inc.</h4>
            <h4>Trial Balance</h4>
            <h4>As of <span class = "date"></span></h4>
        </div>
            <table class="table">
              <tr class = 'table-header-row'>
                <td>ACCOUNT NAME</td>
                <td align="right">DEBIT</td>
                <td align="right">CREDIT</td>
              </tr>
            <?php
               while($tbRow = $queryLeft->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr class='table-row-debit'><td >",$tbRow['account_name'],"</td>";
                  echo "<td align='right' class = 'table-debit'>",$tbRow['balance'],"</td>";
                  echo "<td></td></tr>";
               }
              ?>
                            <?php
               while($LNrRow = $queryLeftNeg->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr class = 'table-row-credit'><td>",$LNrRow['account_name'],"</td>";
                  echo "<td></td>";
                  echo "<td align='right' class='table-credit'>",$LNrRow['balance'],"</td></tr>";
                  
               }

            ?>
              <?php
               while($trRow = $queryRight->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr class = 'table-row-credit'><td>",$trRow['account_name'],"</td>";
                  echo "<td></td>";
                  echo "<td align='right' class='table-credit'>",$trRow['balance'],"</td></tr>";    
               }
            ?>
            <?php
               while($RPRow = $queryRightPos->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr class = 'table-row-credit'><td>",$RPRow['account_name'],"</td>";
                  echo "<td></td>";
                  echo "<td align='right' class='table-credit'>",$RPRow['balance'],"</td></tr>";
                  
               }

            ?>
            <tr>
              <td><strong>Total</strong></td>
              <td id="trial-debit-subtotal" class = "total" align="right"></td>
              <td id="trial-credit-subtotal" class ="total" align="right"></td>
            </tr>
            </table>
        </div>
        <div id = "income-statement-sheet" class ="hide">
          <div class="table-title">
            <h4>Addams and Family Inc.</h4>
            <h4>Income Statement</h4>
            <h4>As of <span class = "date"></span></h4>
          </div>
          <table class = "table">
              <tr class = 'table-header-row'>
               <td>TYPE</td>
               <td>ACCOUNT NAME</td>
               <td>VALUE</td>
              </tr>

              <tr>
                <td><strong>Revenues</strong></td>
                <td></td>
                <td></td>  
              </tr>
               <?php
               
                  while($RevRow = $queryRevenue->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr class=''><td></td>";
                    echo "<td >",$RevRow['account_name'],"</td>";
                    echo "<td align='right' class = 'revenueGroup'>",$RevRow['balance'],"</td>";
                    echo "</tr>";
                 }
                 
               ?>
              <tr>
                <td><strong>Total Revenue</strong></td>
                <td></td>
                <td id ="total-revenue" align = "right" class = "total"></td>  
              </tr>
              <tr>
                 <td><strong>Expenses</strong></td>
                 <td></td><td></td>
              </tr>
              <?php
               
                  while($ExRow = $queryExpenses->fetch(PDO::FETCH_ASSOC)){
                    echo "<tr class=''><td></td>";
                    echo "<td>",$ExRow['account_name'],"</td>";
                    echo "<td align='right' class = 'ExpenesGroup'>",$ExRow['balance'],"</td>";
                    echo "</tr>";
                 }
                 
               ?>

              <tr>
                 <td><strong>Total Expenses</strong></td>
                 <td></td><td id = "total-expenses" class = "total" align="right"></td>
              </tr>
              <tr>
              <td><strong>Net Profit</strong></td>
              <td></td><td  align='right' id = "net-profit" class ="total"></td>
              </tr>
          </table>
        </div>
        <div id = "balance-sheet-sheet" class="hide">
          <div class ="table-title">
            <h4>Addams and Family Inc.</h4>
            <h4>Balance Sheet</h4>
            <h4>As of <span class = "date"></span></h4>
              </div>
              <table class ="table">
                <tr class = 'table-header-row'>
                 <td>NAME</td>
                 <td align="right">ACCOUNT TOTALS</td>
                 <td align="right">SUBTOTALS</td>
                </tr>
                <tr>
                  <td><strong>ASSETS</strong></td><td></td><td></td>
                </tr>

                <?php
                  while($CARow = $queryCA->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr>";
                  echo "<td>",$CARow['account_name'],"</td>";
                  echo "<td align='right' class='CA'>",$CARow['balance'],"</td><td></td></tr>";
                  }
                 ?>
                <tr>
                  <td><strong>Current Assets</strong></td>
                  <td></td>
                  <td id = "current-assets" class = "subtotal" align='right'></td>
                </tr>
                
                 <?php
                  while($LTARow = $queryLTA->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr>";
                  echo "<td>",$LTARow['account_name'],"</td>";
                  echo "<td align='right' class='LTA'>",$LTARow['balance'],"</td><td></td></tr>";
                  }
                 ?>
                <tr>
                 <td><strong>Long Term Assets</strong></td><td></td>
                 <td id = "long-term-assets" class = "subtotal"align='right'>
                 </tr>
                <tr>
                  <td><strong>TOTAL ASSETS</strong></td>
                  <td></td>
                  <td id = "total-assets" class="total"align='right'></td>
                </tr>
                <tr>
                  <td><strong>EQUITY AND LIABILITIES</strong></td>
                  <td></td>
                  <td id = "total-EQ-LIA"align='right'></td>
                </tr>

                <?php
                  while($CLRow = $queryCL->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr>";
                  echo "<td>",$CLRow['account_name'],"</td>";
                  echo "<td align='right' class='CL'>",$CLRow['balance'],"</td><td></td></tr>";
                  }
                 ?>
                <tr>
                  <td><strong>Current Liabilities</strong></td>
                  <td></td>
                  <td id = "total-CL"align='right' class="subtotal"></td>
                </tr>

                <?php
                  while($LTLRow = $queryLTL->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr>";
                  echo "<td>",$LTLRow['account_name'],"</td>";
                  echo "<td align='right' class='LTL'>",$LTLRow['balance'],"</td><td></td></tr>";
                  }
                 ?>
                <tr>
                  <td><strong>Long Term Liabilities</strong></td>
                  <td></td>
                  <td id = "total-LTL"align='right'class="subtotal"></td>
                </tr>
                
                <?php
                  
                  while($OERow = $queryOE->fetch(PDO::FETCH_ASSOC)){
                  echo "<tr>";
                  echo "<td>",$OERow['account_name'],"</td>";
                  echo "<td align='right' class='OE'>",$OERow['balance'],"</td><td></td></tr>";
                  }
                 ?>
                 <tr>
                  <td><strong>Owner's Equity</strong></td>
                  <td></td>
                  <td id = "total-OE"align='right'class = "subtotal"></td>
                </tr>
                 <tr>
                  <td>Retained Earnings</td>
                  <td align ="right" id ="retained-earnings-value"></td>
                  <td></td>
                 </tr>
                <tr>
                  <td><strong>TOTAL EQUITY AND LIABILITIES</strong</td>
                  <td></td>
                  <td align='right' id = "total-EL" class = "total"></td>
                </tr>
              </table>
                 
        </div>
        <div id = "retained-earnings-sheet" class="hide">
          <div class = "table-title">
            <h4>Addams and Family Inc.</h4>
            <h4>Statement of Retained Earnings</h4>
            <h4>As of <span class = "date"></span></h4>
          </div>
          <table class = "table" >
                  <tr class = 'table-header-row'>
                    <td>STATEMENTS</td>
                    <td>VALUES</td>
                  </tr>
                  <tr>
                    <td>Retained earnings at January 1, <span class = "this-year"></span></td>
                    <td align="right"><span id = "prev-retained"> 
                    <?php
                        while($REPrev = $queryREPrevious->fetch(PDO::FETCH_ASSOC)){
                          $total = ($REPrev['sumd'] -$REPrev['sumc']);
                          
                          }
                          echo trim($total);
                    ?>
                    </span></td>

                  </tr>
                  <tr>
                    <td>Add: net income earned in <span class = "this-year"></span></td>
                    <td id="add-net" align="right"></td>
                  </tr>
                  <tr>
                    <td>Less: Dividends</td>
                    <td id = "Dividends" align="right">
                    <?php
                        $c= 0;
                        while($div = $queryDiv->fetch(PDO::FETCH_ASSOC)){
                          echo ($div['sumd'] + 0);
                          $c =$c+1;
                          }
                          if($c == 0){echo 0;}
                    ?>
                    </td>
                  </tr>
                  <tr>
                    <td> Retained earnings at <span class = "this-year"></span></td>
                    <td id = "retained-total" class = "total" align="right"></td>
                  </tr>
          </table>
        </div>
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="./scripts/financialStatements.js" type="text/javascript"></script>
    </body>
</html> 