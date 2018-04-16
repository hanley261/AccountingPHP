function removeZeros(){
    var debitZero = document.getElementsByClassName("table-debit");   
 var creditZero = document.getElementsByClassName("table-credit");

 for(var i = 0; i < creditZero.length;i++){
     if(creditZero[i].innerText == 0){
         creditZero[i].innerText = "-";
     }
 }
 for(var i = 0; i < debitZero.length;i++){
    if(debitZero[i].innerText == 0){
        debitZero[i].innerText = "-";
    }
}
}

function CheckReason(){
    console.log("6");
    console.log($(this).closest("reason").val());
    
}

$(document).ready(function(){
removeZeros();
});