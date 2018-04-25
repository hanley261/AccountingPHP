<?php
// Initialize the session
session_start();
$username = $_SESSION['username'];// grab the session username
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<?php
$config['db'] = array(
	'host'			=>'localhost',
	'username'		=>'rmorga51',
	'password'		=>'',
	'dbname'		=>'accounting'
);
	

$db = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password']); 
$db->setATTRIBUTE(PDO::ATTR_EMULATE_PREPARES, false);
$db->setATTRIBUTE(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);?>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/header.css"/>
  <link rel="stylesheet" href="css/help.css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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


  <div class="container">
    <div>
      <h1>FAQ</h1>
      <p>
        <strong>Click question to view the Answer</strong>
      </p>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse1" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to Login?</p>
        </h4>
      </div>
      <div id="collapse1" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>Login to your <strong>Anywhere Accounting </strong></li>
            <li> At the center page you will have <strong>Input fields</strong></li>
            <li> Enter full <strong>Email Address</strong> as the Username </li>
            <li>Enter <strong>Password</strong>for your Username</li>
          </ol>
      </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to Access Accounts?</p>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>Go to <strong>Account Tab</strong> on top manu</li>
            <li> This will Redirect to <strong>Account Page</strong></li>
            <li> show you all <strong>Active</strong> and <strong>Inactive Accounts</strong> at that time.</li>
          </ol>
      </div>
      </div>
    </div>
    <div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse3" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to Add an Account?</p>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>Go to<strong> Charts of Account page</strong></li>
            <li>Click <strong>Add Account</strong> button</li>
            <li> Once this is selected, you may add any account that comes up in the drop down </li>
            <li>Once finished, the account will be populated in the <strong>Chart Of Accounts page</strong></li>
          </ol>
      </div>
      </div>
    </div>
      </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse4" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to Access Chart of Accounts?</p>
        </h4>
      </div>
      <div id="collapse4" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>Login to your<strong>Anywhere Accounting Account</strong>using <strong>Email</strong> and <strong>Passwrod</strong> </li>
            <li>Select <strong>Chart Of Accounts</strong> from the top menu</li>
            <li>This will redirect you to the <strong>Chart Of Accounts</strong> page in our software </li>
          </ol>
      </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse5" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to Journalize ?</p>
        </h4>
      </div>
      <div id="collapse5" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>Login to your<strong>Anywhere Accounting Account</strong>using <strong>Email</strong> and <strong>Passwrod</strong> </li>
            <li> Click the <strong>Journalize</strong> button on the top menu</li>
            <li> Once, you’ve clicked <strong>Journalize</strong>, you may select a <strong>Date</strong>,
              <strong>Impacted Accounts</strong>,<strong>add a description</strong>,
              and <strong>Attach a file</strong> to support your journal entry </li>
            <li>Click <strong>Submit</strong> button to submit youe Journal Entry</li>
          </ol>
      </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse6" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to view General Legder?</p>
        </h4>
      </div>
      <div id="collapse6" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>Navigate <strong>General Legder</strong> tab this will open
              <strong>General Ledger</strong></li>
          <li>This will display the <strong>General Ledger</strong></li> for any accountant/manager to view</li>

          </ol>
      </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse7" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to view Balance Sheet?</p>
        </h4>
      </div>
      <div id="collapse7" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>Navigate <strong>Balance Sheet</strong> tab this will open
              <strong>Balance Sheet</strong></li>
            <li>This will display the <strong>Balance Sheet</strong></li> for any accountant/manager to view</li>
          </ol>
      </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse8" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to view Trial Balance?</p>
        </h4>
      </div>
      <div id="collapse8" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>Navigate <strong>Trial Balance Sheet</strong> tab this will open
              <strong> Trial Balance Sheet</strong></li>
            <li>This will display the <strong> Trial Balance Sheet</strong></li>for any accountant/manager to view</li>

          </ol>
      </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse9" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to view Income Statements?</p>
        </h4>
      </div>
      <div id="collapse9" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>To get an <strong>Income Statement</strong></li>
            <li> Navigate to the <strong>Income Statement Tab</strong></li>
            <li> This will display the current <strong>Income Statement </strong></li>
          </ol>
      </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 data-toggle="collapse" data-parent="#accordion" href="#collapse10" class="panel-title expand">
           <div class="right-arrow pull-right">+</div>
          <p href="#">Q: How to view Retained Earning?</p>
        </h4>
      </div>
      <div id="collapse10" class="panel-collapse collapse">
        <div class="panel-body">
          <h5><span class="label label-primary">Answer</span></h5>
          <ol>
            <li>To see the <strong>Retained Earnings Statement</strong></li>
            <li>Simply to the <strong>Retained Earnings Statement</strong>tab and you can view it</li>
          </ol>
      </div>
      </div>
    </div>
  </div>
  <script>
  $(function() {
  $('.expand').on('click', function() {
    // $(this).next().slideToggle(200);
    $expand = $(this).find('>:first-child');

    if ($expand.text() == '+') {
      $expand.text('-');
    } else {
      $expand.text('+');
    }
  });
});
</script>

</body>
</html>
