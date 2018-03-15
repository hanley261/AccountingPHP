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


$query = $db->query("SELECT * FROM chart_of_accounts");
//$query2 = $db->query2("UPDATE account_status FROM chart_of_accounts WHERE account_name = 'n/a'");


?>
<html lang = en>
    <head>
                <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <!-- CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
            <link rel="stylesheet" href="css/home.css"/>
            <link rel="stylesheet" href="css/header.css"/>
                <!---Title -->
            <title>AnyWhere-createAccount</title>
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



<!--Create Account -->
<div class="App">
        <div class="col-md-3 cols-md-offset-3">
        <form id="create-account" method="GET" action="">
          <div class="form-group">
              <label htmlFor="account_type">Account Type</label>
              <select id="account_type" class="form-control">
              <option value="" disabled>--Account Type--</option>  
                <option value="Assests">Assets</option>
                <option value="Liabilities">Liabilities</option>
                <option value="Owner's-Equity">Owner's Equity</option>
                <option value="Revenue">Revenue</option>
                <option value="Expenses">Expenses</option>
              </select> 
          </div>
          </form>
          <form  id="create-account" method="POST" action="createAccountUpload.php" enctype="multipart/form-data">
          <div class="form-group">
              <label>
                  Account Name
              </label>
              <select id="normal_side" name="account_name" class="form-control"> 
                <option value = "Cash">Cash</option>
                <option value = "Petty Cash">Petty Cash</option>
                <option value = "Notes Receivables">Notes Receivables</option>
                <option value = "Accounts Receivables">Accounts Receivables</option>
                <option value = "Allowance for Bad Debts">Allowance for Bad Debts</option>
                <option value = "Interest Receivables">Interest Receivables</option>
                <option value = "Common Stock Subscriptions Receivable">Common Stock Subscriptions Receivable</option>
                <option value = "Preferred Stock Subscriptions Receivable">Preferred Stock Subscriptions Receivable</option>
                <option value = "Merchandise Inventory">Merchandise Inventory</option>
                <option value = "Raw Materials">Raw Materials</option>
                <option value = "Work in process">Work in process</option>
                <option value = "Finished Goods">Finished Goods</option>
                <option value = "Supplies">Supplies</option>
                <option value = "Office Supplies">Office Supplies</option>
                <option value = "Food Supplies">Food Supplies</option>
                <option value = "Prepaid Insurance">Prepaid Insurance</option>
                <option value = "Bond Sinking Fund">Bond Sinking Fund</option>
                <option value = "Land">Land</option>
                <option value = "Natural Tesources">Natural Tesources</option>
                <option value = "Accumulated Depreciation">Accumulated Depreciation</option>
                <option value = "Buildings">Buildings</option>
                <option value = "Accumulated Depreciation -- Buildings">Accumulated Depreciation -- Buildings</option>
                <option value = "Office Equipments">Office Equipments</option>
                <option value = "Accumulated Depreciation -- Office Equipment">Accumulated Depreciation -- Office Equipment</option>
                <option value = "Athletic Equipment">Athletic Equipment</option>
                <option value = "Accumulated Depreciation - Athletic Equipment">Accumulated Depreciation - Athletic Equipment</option>
                <option value = "Tennis Facilities">Tennis Facilities</option>
                <option value = "Accumulated Depreciation -- Tennis Facilities">Accumulated Depreciation -- Tennis Facilities</option>
                <option value = "Delivery Equipment">Delivery Equipment</option>
                <option value = "Accumulated Depreciation -- Delivery Equipment">Accumulated Depreciation -- Delivery Equipment</option>
                <option value = "Exercise Equipment">Exercise Equipment</option>
                <option value = "Accumulated Depreciation -- Exercise Equipment">Accumulated Depreciation -- Exercise Equipment</option>
                <option value = "Computer Equipment">Computer Equipment</option>
                <option value = "Accumulated Depreciation -- Computer Equipment">Accumulated Depreciation -- Computer Equipment</option>
                <option value = "Patents">Patents</option>
                <option value = "Copyright">Copyright</option>
                <option value = "Office Equipments">Office Equipments</option>
                <option value = "Notes Payable">Notes Payable</option>
                <option value = "Discount on Notes Payable">Discount on Notes Payable</option>
                <option value = "Accounts Payable">Accounts Payable</option>
                <option value = "United Way Contribution Payable">United Way Contribution Payable</option>
                <option value = "Income Tax Payable">Income Tax Payable</option>
                <option value = "Common Dividends Payable">Common Dividends Payable</option>
                <option value = "Preferred Dividends Payable">Preferred Dividends Payable</option>
                <option value = "Interest Payable">Interest Payable</option>
                <option value = "Employee Income Tax Payables">Employee Income Tax Payables</option>
                <option value = "Social Security Tax Payable">Social Security Tax Payable</option>
                <option value = "Medicare Tax Payable">Medicare Tax Payable</option>
                <option value = "City Earnings Tax Payable">City Earnings Tax Payable</option>
                <option value = "Health Insurance Premium Payable">Health Insurance Premium Payable</option>
                <option value = "Credit Union Payable">Credit Union Payable</option>
                <option value = "Savings Bond Deductions Payable">Savings Bond Deductions Payable</option>
                <option value = "Wages Payable">Wages Payable</option>
                <option value = "FUTA Tax Payable">FUTA Tax Payable</option>
                <option value = "SUTA Tax Payable">SUTA Tax Payable</option>
                <option value = "Workers' compensation Insurance Payable">Workers' compensation Insurance Payable</option>
                <option value = "Sales Tax Payable">Sales Tax Payable</option>
                <option value = "Unearned Subscription Revenue">Unearned Subscription Revenue</option>
                <option value = "Current Portion of Mortgage Payable">Current Portion of Mortgage Payable</option>
                <option value = "Mortgage Payable">Mortgage Payable</option>
                <option value = "Bonds Payable">Bonds Payable</option>
                <option value = "Discount on Bonds Payble">Discount on Bonds Payble</option>
                <option value = "Premium on Bonds Payable">Premium on Bonds Payable</option>
                <option value = "Jessica Jane, Capital">Jessica Jane, Capital</option>
                <option value = "Jessica Jane, Drawing">Jessica Jane, Drawing</option>
                <option value = "Income Summary">Income Summary</option>
                <option value = "Common Stock">Common Stock</option>
                <option value = "Common Treasury Stock">Common Treasury Stock</option>
                <option value = "Paid in Capital in Excess of Par/ Stated Value --Common Stock">Paid in Capital in Excess of Par/ Stated Value --Common Stock</option>
                <option value = "Preferred Stock">Preferred Stock</option>
                <option value = "Preferred Treasury Stock">Preferred Treasury Stock</option>
                <option value = "Discount on Preferred Stock">Discount on Preferred Stock</option>
                <option value = "Paid in Capital in Excess of Par/ Stated Value -- Preferred Stock">Paid in Capital in Excess of Par/ Stated Value -- Preferred Stock</option>
                <option value = "Retained Earnings">Retained Earnings</option>
                <option value = "Retained Earnings Appropriated for...">Retained Earnings Appropriated for...</option>
                <option value = "Retained Earnings Appropriated for..">Retained Earnings Appropriated for..</option>
                <option value = "Common Stock Subscribed">Common Stock Subscribed</option>
                <option value = "Preferred Stock Subscribed">Preferred Stock Subscribed</option>
                <option value = "Paid in Capital From Sale of Treasury Stock">Paid in Capital From Sale of Treasury Stock</option>
                <option value = "Delivery Fees">Delivery Fees</option>
                <option value = "Appraisal Fees">Appraisal Fees</option>
                <option value = "Medical Fees">Medical Fees</option>
                <option value = "Service Fees">Service Fees</option>
                <option value = "Repair Fees">Repair Fees</option>
                <option value = "Sales">Sales</option>
                <option value = "Sales Returns and Allowances">Sales Returns and Allowances</option>
                <option value = "Sales Discount">Sales Discount</option>
                <option value = "Boarding and Grooming Revenue">Boarding and Grooming Revenue</option>
                <option value = "Subscriptions Revenue(if mainline of business)">Subscriptions Revenue(if mainline of business)</option>
                <option value = "Interest Revenue">Interest Revenue</option>
                <option value = "Rent Revenue">Rent Revenue</option>
                <option value = "Subscriptions Revenue(not main line of business)">Subscriptions Revenue(not main line of business)</option>
                <option value = "Sinking Fund Earnings">Sinking Fund Earnings</option>
                <option value = "Uncollectible Accounts Recovered">Uncollectible Accounts Recovered</option>
                <option value = "Gain on Sale/Exchange of Equipment">Gain on Sale/Exchange of Equipment</option>
                <option value = "Gain on Bonds Redeemed">Gain on Bonds Redeemed</option>
                <option value = "Purchases">Purchases</option>
                <option value = "Purchases Returns and Allowances">Purchases Returns and Allowances</option>
                <option value = "Purchases Discount">Purchases Discount</option>
                <option value = "Freight-In">Freight-In</option>
                <option value = "Overhead">Overhead</option>
                <option value = "Cost of Goods Sold">Cost of Goods Sold</option>
                <option value = "Wages Expense">Wages Expense</option>
                <option value = "Advertising Expense">Advertising Expense</option>
                <option value = "Bank Credit Card Expense">Bank Credit Card Expense</option>
                <option value = "Store Supplies Expense">Store Supplies Expense</option>
                <option value = "Travel and Entertainment Expense">Travel and Entertainment Expense</option>
                <option value = "Cash Short and Over">Cash Short and Over</option>
                <option value = "Depreciation Expense-- Store Equipment and Fixtures">Depreciation Expense-- Store Equipment and Fixtures</option>
                <option value = "Rent Expense">Rent Expense</option>
                <option value = "Office Salaries Expense">Office Salaries Expense</option>
                <option value = "Office Supplies Expense (Also Medical)">Office Supplies Expense (Also Medical)</option>
                <option value = "Other Supplies: Food Supplies Expense">Other Supplies: Food Supplies Expense</option>
                <option value = "Telephone Expense">Telephone Expense</option>
                <option value = "Transportation/Automobiles Expense">Transportation/Automobiles Expense</option>
                <option value = "Collection Expense">Collection Expense</option>
                <option value = "Inventory Short and Over">Inventory Short and Over</option>
                <option value = "Loss on Write Down of Inventory">Loss on Write Down of Inventory</option>
                <option value = "Payroll Taxes Expense">Payroll Taxes Expense</option>
                <option value = "Workers' compensation Insurance Expense">Workers' compensation Insurance Expense</option>
                <option value = "Bad Debt Expense">Bad Debt Expense</option>
                <option value = "Charitables Contributions Expense">Charitables Contributions Expense</option>
                <option value = "Insurance Expense">Insurance Expense</option>
                <option value = "Postage Expense">Postage Expense</option>
                <option value = "Repair Expense">Repair Expense</option>
                <option value = "Oil and Gas Expense">Oil and Gas Expense</option>
                <option value = "Depreciation Expense--Building">Depreciation Expense--Building</option>
                <option value = "Depreciation Expense--Equipment">Depreciation Expense--Equipment</option>
                <option value = "Depreciation Expense">Depreciation Expense</option>
                <option value = "Depletion Expense">Depletion Expense</option>
                <option value = "Patent Amortization">Patent Amortization</option>
                <option value = "Amortization of Organization Costs">Amortization of Organization Costs</option>
                <option value = "Miscellaneous Expense">Miscellaneous Expense</option>
                <option value = "Interest Expense">Interest Expense</option>
                <option value = "Loss on Discarded Equipment">Loss on Discarded Equipment</option>
                <option value = "Loss of Sale/Exchange of Equipment">Loss of Sale/Exchange of Equipment</option>
                <option value = "Loss on Bonds Redeemed">Loss on Bonds Redeemed</option>
                <option value = "Income Tax Expense">Income Tax Expense</option>
              </select>
          </div>
          <div class="form-group">
              <label>
              Is Active:
              </label>
              <select id="account_name" name="account_status" class="form-control">
              <option value="" disabled>--Account Type--</option>  
                <option value="ACTIVE">Active</option>
                <option value="INACTIVE">Inactive</option>

              </select> 
          </div>
          <div class="form-group">
              <label>
                  Initial Balance
              </label>
              <input id="inital_balance" class="form-control" type="number" name="balance" value="0.00"/>
              
          </div>
          <div class="row">
            <div class="">
                <button class="btn btn-danger left" type="reset"> Cancel</button>
                <input class="btn btn-success right" type="submit" value="submit">
            </div>
            
          </div>
      </form>
    </div>
        </div>




    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    </body>
</html>