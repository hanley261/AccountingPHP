function removeZeros(){
    var debitZero = document.getElementsByClassName("table-debit");   
 var creditZero = document.getElementsByClassName("table-credit");
 console.log(creditZero[2].innerText);
 for(var i = 0; i < creditZero.length;i++){
     if(creditZero[i].innerText == 0){
         console.log(creditZero[i].value);
         creditZero[i].innerText = " -";
     }
 }
 for(var i = 0; i < debitZero.length;i++){
    if(debitZero[i].innerText == 0){
        console.log(debitZero[i].innerText);
        debitZero[i].innerText = " -";
    }
}
}



$(document).ready(function(){
removeZeros();
});