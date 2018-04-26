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
<!doctype html>
<?php
$config['db'] = array(
	'host'			=>'localhost',//'rmorga5180688.ipagemysql.com',
	'username'		=>'rmorga51',
	'password'		=>'',
	'dbname'		=>'accounting'
);

$db = new PDO('mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['dbname'], $config['db']['username'], $config['db']['password']); 
$db->setATTRIBUTE(PDO::ATTR_EMULATE_PREPARES, false);
$db->setATTRIBUTE(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/* Filter for manager Review  */
if(isset  ($_GET['Subject'])){
  $filter = ($_GET['Subject']);
 
}
else{
  $filter = 'pending';
}
$query = $db->query("SELECT * FROM journal_entry WHERE approval_status = '$filter' ORDER BY date1 ASC");
$query2 = $db->query("SELECT * FROM je_accounts WHERE transaction_id = 1");
$query3 = $db->query("SELECT * FROM journal_entry INNER JOIN je_accounts ON journal_entry.transaction_id = je_accounts.transaction_id ORDER BY date1 ASC");
?>
<html lang = en>
    <head>
                <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <!-- CSS -->
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <link rel="stylesheet" href="css/JournalEntry.css"/>
            <link rel="stylesheet" href="css/header.css"/>
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
				if($userType == 'manager'){ 
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







            <!--Manager Review-->

            <div className="App">
                    <legend class="" align="center" text-size=""><strong>Manager Review</strong></legend>
                    <hr/>


                    <form method="get" action="ManagerReview.php" class ="form-inline"> 
                    <select  name="Subject" class ="form-control">
                      <option selected="selected" value="pending" >Pending</option>
                      <option value="approved">Approved</option>
                      <option value="rejected">Rejected</option>
                    </select>
                    <input class = "btn btn-success float-right" align = "right" type="submit" value="Filter">
                    </form>
                    <!--Table-->
                    <table class = "table table-stripped">
                        <tr class="table-header-row">
                            <td><strong>DATE</strong></td>
                            <td><strong>ACCOUNT NAME</strong></td>
                            <td><strong>REF</strong></td>
                            <td><strong>DEBIT</strong></td>
                            <td><strong>CREDIT</strong></td>                            
                            <td><strong>USER ID</strong></td>
                        
                        </tr>
                       <?php 
                        while($row = $query->fetch(PDO::FETCH_ASSOC)){
                      echo '<form method="POST" action="managerReviewUpload.php" enctype="multipart/form-data"><tr>';
                      echo '<td>',$row['date1'],'</td>';
                      echo '<td>';
                      $transaction_id = $row['transaction_id'];
                      $_SESSION['transaction_id'] = $transaction_id;    
                      $query4 = $db->query("SELECT * FROM je_accounts WHERE transaction_id = $transaction_id ORDER BY debit DESC");
                      while($name = $query4->fetch(PDO::FETCH_ASSOC)){
                        echo '<div>',$name['account_name'], '</div>';
                      } 
                      echo '<td> <input readonly name = "transaction_id" value = "',$row['transaction_id'],'"></td>';
                      echo '</td>';
                      echo '<td>';
                      $query6 = $db->query("SELECT * FROM je_accounts WHERE transaction_id = $transaction_id ORDER BY debit DESC");
                      while($name = $query6->fetch(PDO::FETCH_ASSOC)){
                        echo '<div class="table-debit">',$name['debit'], '</div>';
                      } 
                      echo '</td>';
                      echo '<td>';
                      $query5 = $db->query("SELECT * FROM je_accounts WHERE transaction_id = $transaction_id ORDER BY debit DESC");
                      while($name = $query5->fetch(PDO::FETCH_ASSOC)){
                        
                        echo '<div class="table-credit">',$name['credit'], '</div>';
                      } 
                      echo '</td>';
                      echo '<td>',$row['user_id'],'</td>';
                      echo '</tr><tr>';

                      echo '<td rowspan="2"><label>Description:&nbsp &nbsp </label>',$row['description1'],'</td>';             
                      echo '<td rowspan="2"><label>Reason:&nbsp &nbsp </label><input class ="reason"/></td>';
                      
                      if($filter == 'approved'){
                        echo '<td rowspan="1"><div class= "btn btn-success"> Approved</div> </td> ';
                      }
                      elseif($filter == 'rejected'){
                        echo '<td rowspan="1"><div class= "btn btn-danger">Rejected</div> </td> ';
                      }
                      else{
                          echo '<td rowspan="1">    <div class="journalEntry-buttons">
                          <input onClick="CheckReason()" name = "reject" class="btn btn-danger" type = "submit" value ="Reject">
                          <input name ="approve" class="btn btn-success" type="submit" />
                          </div></td>';
                      }
                      echo '</tr></form>';
                    }
                      ?>
                  </table>
                </div>

                

    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="./scripts/managerReview.js" type ="text/javascript"></script>
    </body>
</html>