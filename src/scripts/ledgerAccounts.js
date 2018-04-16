
function hideEmptyAccounts (){
    var accounts = $(".show1");
    for(var i = 0; i < accounts.length;i++){
        if(accounts[i].getElementsByTagName("tr").length < 2){            
            accounts[i].className = "hide";  
        }
    }
}
function removeZeros(){
    var debitZero = document.getElementsByClassName("table-debit");   
 var creditZero = document.getElementsByClassName("table-credit");
 for(var i = 0; i < creditZero.length;i++){
     if(creditZero[i].innerText == 0){         
         creditZero[i].innerText = " ";
     }
 }
 for(var i = 0; i < debitZero.length;i++){
    if(debitZero[i].innerText == 0){       
        debitZero[i].innerText = " ";
    }
}
}
function searchForAccounts(){
    
    var input, filter, tables, name;
    input = document.getElementById("search");  
    
    filter = input.value.toUpperCase();   
    tables = $(".show1");
    
    for (i = 0; i < tables.length; i++) {
        name = tables[i].getElementsByClassName("table-title")[0];
        if (name.innerText.toUpperCase().indexOf(filter) > -1) {
            tables[i].style.display = "";          
        } else {
            tables[i].style.display = "none";          
        }
    }   
    
}

$(document).ready(function(){
    removeZeros();
$("#search").keyup(searchForAccounts)
hideEmptyAccounts();

});
