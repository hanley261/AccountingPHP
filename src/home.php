<?php
// Initialize the session
session_start();
$username = $_SESSION['username'];// grab the session username
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
  

}

$config['db'] = array(
	'host'			=>'localhost',
	'username'		=>'rmorga51',
	'password'		=>'',
	'dbname'		=>'accounting'
);
	

$db = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password']); 
$db->setATTRIBUTE(PDO::ATTR_EMULATE_PREPARES, false);
$db->setATTRIBUTE(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>
<!doctype html>
<html lang = en>
    <head>
                <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <!-- CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <!--<link rel="stylesheet" href="css/home.css"/>-->
            <link rel="stylesheet" href="css/header.css"/>
           

            <link rel="stylesheet" href="./css/dashboard.css" />
                <!---Title -->
            <title>AnyWhere-Home</title>
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



            <!--Home-->
            <legend class="" align="center" text-size=""><strong>Dashboard</strong></legend>
<div class="container">
  <div class="col-lg-4 col-md-6">
    <div class=" panel panel-warning" >
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">

          </div>
          <div class="col-xs-9 text-right">
            <div class="huge">
            <?php
                $queryCA = $db->prepare("SELECT SUM(balance) AS sumCA FROM chart_of_accounts WHERE account_subtype = 'Current Asset'");  // grab user_type of matching username
                $queryCA->execute();
                $rowCA = $queryCA->fetchAll(PDO::FETCH_OBJ);
                $sumCA = $rowCA[0]->sumCA;
                

                $queryCL = $db->prepare("SELECT SUM(balance) AS sumCL FROM chart_of_accounts WHERE account_subtype = 'Current Liability'");  // grab user_type of matching username
                $queryCL->execute();
                $rowCL = $queryCL->fetchAll(PDO::FETCH_OBJ);
                $sumCL = $rowCL[0]->sumCL;
                $currentRatio =$sumCA/abs($sumCL);
                echo "<h1>",round($currentRatio,2),"%</h1>";
            ?>

            </div>
          </div>
        </div>

      </div>
      <div class="panel-body"><strong>Current Ratio</strong></div>
    </div>
  </div>
  <div class="col-lg-4 col-md-6">
    <div class=" panel panel-warning" >
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge">
            <?php
                

                $queryCL = $db->prepare("SELECT SUM(balance) AS sumCL FROM chart_of_accounts WHERE account_subtype = 'Current Liability'");  // grab user_type of matching username
                $queryCL->execute();
                $rowCL = $queryCL->fetchAll(PDO::FETCH_OBJ);
                $sumCL = $rowCL[0]->sumCL;

                $queryCA = $db->prepare("SELECT SUM(balance) AS sumCA FROM chart_of_accounts WHERE account_subtype = 'Current Asset'");  // grab user_type of matching username
                $queryCA->execute();
                $rowCA = $queryCA->fetchAll(PDO::FETCH_OBJ);
                $sumCA = $rowCA[0]->sumCA;


                $queryI = $db->prepare("SELECT SUM(balance) AS sumI FROM chart_of_accounts WHERE account_name = 'Merchandise Inventory'");  // grab user_type of matching username
                $queryI->execute();
                $rowI = $queryI->fetchAll(PDO::FETCH_OBJ);
                $sumI = $rowI[0]->sumI;
                $QRatio =(abs($sumCA - $sumI))/abs($sumCL);
                echo "<h1>",round($QRatio,2),"%</h1>";
            ?>
            </div>
          </div>
        </div>

      </div>
      <div class="panel-body"><strong>Quick Ratio</strong></div>
    </div>

  </div>
  <div class="col-lg-4 col-md-6">
    <div class=" panel panel-red" >
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge">
            <?php
              $queryTD = $db->prepare("SELECT SUM(balance) AS sumTD FROM chart_of_accounts WHERE account_type = 'Liability'");  // grab user_type of matching username
              $queryTD->execute();
              $rowTD = $queryTD->fetchAll(PDO::FETCH_OBJ);
              $sumTD = $rowTD[0]->sumTD;


              $queryTE = $db->prepare("SELECT SUM(balance) AS sumTE FROM chart_of_accounts WHERE account_type = 'Equity'");  // grab user_type of matching username
              $queryTE->execute();
              $rowTE = $queryTE->fetchAll(PDO::FETCH_OBJ);
              $sumTE = $rowTE[0]->sumTE;
              
              $DEratio = abs($sumTD)/abs($sumTE);
              echo "<h1>",round($DEratio,2),"%</h1>";
              ?>
            </div>
          </div>
        </div>

      </div>
      <div class="panel-body"><strong>Debit to Equity Ratio</strong></div>
    </div>
    <!--Netxt -->
  </div>
  <div class="col-lg-4 col-md-6">
    <div class=" panel panel-red">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge">
            <?php
              $queryTD = $db->prepare("SELECT SUM(balance) AS sumTD FROM chart_of_accounts WHERE account_name = 'Sales'");  // grab user_type of matching username
              $queryTD->execute();
              $rowTD = $queryTD->fetchAll(PDO::FETCH_OBJ);
              $sumTD = $rowTD[0]->sumTD;


              $queryA = $db->prepare("SELECT SUM(balance) AS sumA FROM chart_of_accounts WHERE account_type = 'Asset'");  // grab user_type of matching username
              $queryA->execute();
              $rowA= $queryA->fetchAll(PDO::FETCH_OBJ);
              $sumA = $rowA[0]->sumA;
              
              $DEratio = abs($sumTD)/abs($sumA);
              echo "<h1>",round($DEratio,2),"%</h1>";
              ?>
            </div>
          </div>
        </div>

      </div>
      <div class="panel-body"><strong>Total Asset Turnover</strong></div>
    </div>
  </div> <!-- End Netxt -->

  <div class="col-lg-4 col-md-6">
    <div class=" panel panel-red" >
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-3">
          </div>
          <div class="col-xs-9 text-right">
            <div class="huge">
            <?php
              $queryTD = $db->prepare("SELECT SUM(balance) AS sumTD FROM chart_of_accounts WHERE account_type = 'Liability'");  // grab user_type of matching username
              $queryTD->execute();
              $rowTD = $queryTD->fetchAll(PDO::FETCH_OBJ);
              $sumTD = $rowTD[0]->sumTD;


              $queryTE = $db->prepare("SELECT SUM(balance) AS sumTE FROM chart_of_accounts WHERE account_type = 'Asset'");  // grab user_type of matching username
              $queryTE->execute();
              $rowTE = $queryTE->fetchAll(PDO::FETCH_OBJ);
              $sumTE = $rowTE[0]->sumTE;
              
              $DEratio = abs($sumTD)/abs($sumTE);
              echo "<h1>",round($DEratio,2),"%</h1>";
              ?>
            </div>
          </div>
        </div>

      </div>
      <div class="panel-body"><strong>Debt to Asset Ratio</strong></div>
    </div>
  </div><!--End Netxt -->

  

  </div>
</div>




     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
            <!--<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>