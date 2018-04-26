var debitDisplay= 1;
var creditDisplay= 1;
var errorBox = document.getElementById("errorBox");
var form = document.getElementById("form");

/*
Calendar
*/
var date = new Date();
var month = date.getMonth()+1;
var day = date.getDate();
var today = (month<10 ? '0' : '') + month + '/'+ (day<10 ? '0' : '') + day +'/' + date.getFullYear();
    
$('#datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    minDate: today
});

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
  $( "#datepicker" ).validate({
    rules: {
      field: {
        required: true,
        date: true
      }
    }
  });


/*
Table functions 
*/

/*Add New Rows */
function addDebit(){
  $(".DebitRows:first").clone().insertAfter(".DebitRows:last");
  var rows = $(".DebitRows");
  rows[debitDisplay].style.display="";
  debitDisplay++;
}
function addCredit(){
  $(".CreditRows:first").clone().insertAfter(".CreditRows:last");
  var rows = $(".CreditRows");
  rows[creditDisplay].style.display="";
  creditDisplay++;
}
/* Remove Row */
function removeRow(){
  $(".remove").on('click',function(events){
  var row = $(this).closest('tr');
  row.remove();
});
}
/*
Subtotals 
*/
function subtotalDebits(){
  var debits = $(".debitBox");
  var sub = 0;
  for(var i = 1; i < debits.length;i++){
    sub += Number(debits[i].value);
  } 
  document.getElementById("debitSub").value = sub;
}
function subtotalCredits(){
  var credits = $(".creditBox");
  var sub = 0;
  for(var i = 1; i < credits.length;i++){
    sub += Number(credits[i].value);
  } 
  document.getElementById("creditSub").value = sub;
}/*
Destroy the copy element for credits
*/
function destroyFirstCredit(){
  var credits = $(".CreditRows:first");
  credits.remove();
}

/*
 Ready to submit???
 */
function DateReady(){
  var date1 = document.getElementById("datepicker");   
  if(date1.value.length ==  10){
    return true;
  }
  else{
    errorBox.innerText = "Invalid Date";
    return false;
  }
}
function trialBalance(){
  if(document.getElementById("debitSub").value <= 0){
    errorBox.innerText = "The balance needs to be greater than zero";
    return false;
  }
  else if(document.getElementById("debitSub").value == document.getElementById("creditSub").value){
    return true;
  }
  else if(document.getElementById("debitSub").value > document.getElementById("creditSub").value){
    errorBox.innerText = "Debits are greater than Credits"
    return false;
  }
  else{
    errorBox.innerText = "Credits are greater than Debits"
    return false;
  }
}
function description(){
  if(document.getElementById("description").value.length > 0){
    return true;
  }
  else{
    errorBox.innerText = "Please enter a description for the transaction";
    return false;
  }
}
function emptyvalue(collection){
  for(var i = 0; i < collection.length;i++){
      if(collection[i].value <= 0){
        collection[i].value = 0;
      }
  }
}
function checkAccounts(){
  var accounts =document.getElementsByTagName("select");
  for(var i =0; i < accounts.length;i++){
      for(var j =0; j<accounts.length;j++){
        if(j != i){
            if(accounts[i].value == accounts[j].value){
              return false;
            }
        }
      }
  }
  return true;
}
function SubmitReady(){
  var debits = document.getElementsByClassName("debitBox");
  var credits = document.getElementsByClassName("creditBox");
  emptyvalue(debits);
  emptyvalue(credits);
  errorBox.innerText = "";
    if(DateReady()){
      if(trialBalance()){
       if(description()){
          destroyFirstCredit();
          form.submit();
       }
      }
    }
  
  
}


$(document).ready(function(){
  $("#addCredit").click(addCredit);
  $("#addDebit").click(addDebit);
  $(".debitBox").click(subtotalDebits);
  $("#submit").click(SubmitReady);
  addCredit();
  addDebit();
});
  

 
