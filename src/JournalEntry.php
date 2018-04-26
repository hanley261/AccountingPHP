<?php
// Initialize the session
ini_set("display_errors", "1");
error_reporting(E_ALL);
session_start();
 $username = $_SESSION['username'];

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


$query = $db->query("SELECT MAX(transaction_id)+1 AS max_number FROM journal_entry");
$query2 = $db->query("SELECT * FROM chart_of_accounts WHERE account_status = 'ACTIVE' ORDER BY account_name ASC");
$query3 = $db->query("SELECT * FROM chart_of_accounts WHERE account_status = 'ACTIVE' ORDER BY account_name ASC");
$query4 = $db->query("SELECT MAX(transaction_id)+1 AS max_number FROM journal_entry");

?>
<html lang = en>
    <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
            <link rel="stylesheet" href="css/header.css"/>
            <link rel="stylesheet" href="css/JournalEntry.css"/>
            <!--Date Picker-->
            <link href="https://cdn.jsdelivr.net/npm/gijgo@1.8.2/combined/css/gijgo.min.css" rel="stylesheet" type="text/css" />
            <!---Title -->
            <title>AnyWhere-Journal Entry</title>
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
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./JournalEntry.php">Journal Entry</a>
                </li>';	
				}
				?>
				
				<?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType == 'Manager'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./ManagerReview.php">Manager Review</a>
                </li>';	
				}
				?>
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./ledgerAccounts.php">Accounts Ledgers</a>
                </li>';	
				}
				?>
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./accounts.php">Accounts</a>
                </li>';	
				}
				?>
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
				if($userType != 'Administrator'){ 
				echo ' <li class="nav-item">
                         <a class="nav-link" href="./FinancialStatements.php">Financial Statements</a>
                </li>';	
				}
				?>
                  <?php // to hide 'Manager review' based on user type
				$query1 = $db->query("SELECT * FROM users WHERE username = '$username'");  // grab user_type of matching username
				while($row = $query1->fetch(PDO::FETCH_ASSOC)){
					$userType = $row['user_type'];
				}
				/* if the username is equal to Regular, do not show the Manager review link*/
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



            <!--Journal Entry Page -->
            
            <div className="App">
                    <legend class="" align="center" text-size=""><strong>Journal Entry</strong></legend>
                  
                   

                    <!--Table-->
                 <form id = "form" method="post" action="JournalEntryUpload.php" enctype="multipart/form-data">
                    <input id="datepicker" width="276" type="text" name = "date1" value = "" readonly/>
                    <!--Date Picker -->
                    <div id = "datepick" class="input-group date" data-provide="datepicker">
                            
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                    </div>

                    <table id="JEtable" class = "table table-stripped">
                        <tr class="table-header-row">                          
                            <td><strong>NAME</strong></td>                            
                            <td><strong>Ref</strong></td>
                            <td><strong>DEBIT</strong></td>
                            <td><strong>CREDIT</strong></td>                           
                        </tr>
                        <tr class="DebitRows" style="display:none">
                           <td><select name="account_name[]" class="form-control"> 
              
                            <?php
                            while($row = $query2->fetch(PDO::FETCH_ASSOC)){
                              echo '<option class = "accounts" value ="',$row['account_name'],'">',$row['account_name'],'</option>';
                            }
                            ?>
                             </select></td>


                          <td>
                          <?php 
                            while($max = $query->fetch(PDO::FETCH_ASSOC)){
                              echo '<input readonly name ="transaction_id" type = "text" value ="',$max['max_number'],'">';
                            }
                            ?>
                          </td>
                          <td><input onKeyUp="subtotalDebits()" class = "debitBox" type="number" step="0.01" value="" min = "0" name="debit[]"><span class="remove" onClick="removeRow()">-</span></td>            
                          <td><input  onKeyUp="subtotalCredits()" class ="hide" type="number" step="0.01" value="" min = "0"name="credit[]"></td>
                    </tr>
        
                    <tr class="CreditRows" style="display:none">
              <td><select name="account_name[]" class="form-control"> 
              
                 <?php
              			while($row = $query3->fetch(PDO::FETCH_ASSOC)){
                      echo '<option class = "accounts" value ="',$row['account_name'],'">',$row['account_name'],'</option>';
                    }
                 ?>
              </select>
              </td>


              <td>
               <?php 
                while($max = $query4->fetch(PDO::FETCH_ASSOC)){
                  echo '<input readonly name ="transaction_id" type = "text" value ="',$max['max_number'],'">';
                }
                ?>
              </td>
              <td><input  onKeyUp="subtotalCredits()" class ="hide" type="number" step="0.01" value="" min = "0"name="debit[]"></td>
              <td><input  onKeyUp="subtotalCredits()" class ="creditBox" type="number" step="0.01" value="" min = "0"name="credit[]"><span class="remove" onClick="removeRow()">-</span></td>
              
            
                    
                    
                      
                    </tr>
                  </table>

                </div>
                
                <div id = "transaction-left">
                  <label>Debit subtotal:</label>  <input id ="debitSub" value="0" readonly/> 
                  <label>Credit subtotal:</label>  <input id ="creditSub" value="0" readonly/>
                
                <div id="btn-add">                
                      <button type ="button" id="addDebit"class ="btn-success">Add Debit</button>
                      <button type ="button" id="addCredit"class ="btn-success">Add Credit</button>
                    </div>
                </div>



                <!--For the whole Journal Entry-->
                <div id ="transaction-right">
                    <div id ="a" class = "journalEntry-description">
                      <h3>Description</h3>
                      <input id = "description" class = "form-control" maxlength="254" name = "description1"></input>
             
                      <input type="file" id="upload-file">
                    </div>
                </div>
                <div id="submission">
                    <div id ="errorBox"></div>
                    <div class="journalEntry-buttons">
                        <button class="btn-danger"><a id= "cancel" href="./JournalEntry.php">Cancel</a></button>
                        <div id = "submit" class="btn btn-success right" name="submit" value="submit">Submit</div>
                    </div>
              </div>
                </form>


    <!-- dependices--> 
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/gijgo@1.8.2/combined/js/gijgo.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <!--imported javascript files-->
    <script src="./scripts/JournalEntry.js" type="text/javascript"></script>
    </body>
</html>