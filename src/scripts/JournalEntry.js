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
  console.log(row.html);
  row.remove();
});
}
/*
Subtotals 
*/
function subtotalDebits(){
  var debits = $(".debitBox");
  var sub = 0;
  console.log(debits.length);
  for(var i = 1; i < debits.length;i++){
    sub += parseInt(debits[i].value);
  } 
  document.getElementById("debitSub").value = sub;
}
function subtotalCredits(){
  var credits = $(".creditBox");
  var sub = 0;
  console.log(credits.length);
  for(var i = 1; i < credits.length;i++){
    sub += parseInt(credits[i].value);
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
  console.log("dateready");
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
  console.log("trial Balance");
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
  console.log("description");
  if(document.getElementById("description").value.length > 0){
    return true;
  }
  else{
    errorBox.innerText = "Please enter a description for the transaction";
    return false;
  }
}
function SubmitReady(){
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
  

 
