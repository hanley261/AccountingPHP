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


$query = $db->query("SELECT MAX(transaction_id)+1 FROM journal_entry");
$query2 = $db->query("SELECT * FROM chart_of_accounts WHERE account_status = 'ACTIVE' ORDER BY account_name ASC");


?>
<html lang = en>
    <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <!-- CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#myNavbar">
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
                  <li class="nav-item">
                        <a class="nav-link" href="./JournalEntry.php">Journal Entry</a>
                </li>
                <li class="nav-item">
                         <a class="nav-link" href="./ManagerReview.php">Manager Review</a>
                </li>
                  <li class="nav-item">
                    <a class="nav-link" href="./accounts.php">Accounts</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link" href="./logs.php">Logs</a>
                </li>
      
                </ul>
              </div>
              <div class="pull-right">
                <ul class="nav navbar-nav navbar-right">
                  <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="navbarDropdown" href="./login.php"><span class="glyphicon glyphicon-user"></span>Login</a>
                  </li>
                </ul>
              </div>
            </nav>


            <!--Journal Entry Page -->
            
            <div className="App">
                    <legend class="" align="center" text-size=""><strong>Journal Entry</strong></legend>
                  
                   

                    <!--Table-->
                 <form method="post" action="JournalEntryUpload.php" enctype="multipart/form-data">
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
                            <td><strong>DATE</strong></td>
                            <td><strong>Ref</strong></td>
                            <td><strong>DEBIT</strong></td>
                            <td><strong>CREDIT</strong></td>                           
                        </tr>
                        <?php

?>
<tr class="layoutRow">
              <td><select id="accountNameSelect" name="account_name[]" class="form-control"> 
              
          <?php
              			while($row = $query2->fetch(PDO::FETCH_ASSOC)){
                      echo '<option class = "accounts" value ="',$row['account_name'],'">',$row['account_name'],'</option>';
                    }
          ?>
              </select></td>
              <td><input class="dateSet" name="" readonly></td>
              <td><input readonly name ="transaction_id[]" type = "text" value ="REF#"></td>
              <td><input class = "debitBox" type="number" step="0.01" value="" min = "0" name="debit[]"></td>
              <td><input class ="creditBox" type="number" step="0.01" value="" min = "0"name="credit[]"></td>
            
                    
                    </tr>

                  </table>

                </div>
                <div id="btn-add">                
                      <button type ="button" id="addAccount"class ="btn-success">Add Account</button>
                    </div>



                <!--For the whole Journal Entry-->
                    <div id ="a" class = "journalEntry-description">
                      <h3>Description</h3>
                      <textarea class = "form-control" maxlength="254" name = "description1"></textarea>
                      <input type="file" id="upload-file">
                    </div>
                    <div class="journalEntry-buttons">
                        <button class="btn-danger"><a id= "cancel" href="./home.php">Cancel</a></button>
                        <input id = "submitAll" class="btn btn-success right" type="submit" name="submit" value="submit">
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