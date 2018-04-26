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
function format(){
    var debits = document.getElementsByClassName("table-debit");
    var credits = document.getElementsByClassName("table-credit");
    var totalDebits = document.getElementsByClassName("totalDebits");
    var totalCredits = document.getElementsByClassName("totalCredits");

    loopCFD(debits);
    loopCFD(credits);
    loopCFD(totalDebits);
    loopCredit(totalCredits);
    
    addDollar(totalDebits);
    addDollar(totalCredits);
}
function addDollar(collection){
    for(var j = 0; j <collection.length;j++){
        collection[j].innerText = "$ " +collection[j].innerText;
    }
}
function loopCredit(collection){
    var group;
    
    for(var i = 0; i < collection.length; i++){
        if(collection[i].innerText != ""){
            collection[i].innerText = Math.abs(collection[i].innerText);
        }
        
    }
    loopCFD(collection);
}
function loopCFD(collection){
    for(var i= 0;i < collection.length;i++ ){
        if(collection[i].innerText != ""){
        checkForDecimal(collection[i]);
        }
    }
}

function checkForDecimal(element){
    console.log(element.innerText.length );
    if(element.innerText.length > 1 && element.innerText != "-"){
    if(element.innerText.indexOf(".") == -1){
        element.innerText = element.innerText + ".00";
    }
    index = element.innerText.indexOf(".");
    count2 = 0;
    for(var i =index-1; i >0; i--){
        count2++;        
        if(count2 >=3){
            count2 =0;
            element.innerText = insertCommas(element.innerText,i );
        }
    }
}
}
function insertCommas(number, index){
    var right = number.slice(index, number.length);
    var left = number.slice(0, index);
    number = left +","+right;
    number = negAndCom(number);
    return number;
}
function negAndCom(number1){
    if(number1.charAt(0) == "-" && number1.charAt(1) == ","){
        number1 = number1.replace("-,","-");
    }
    return number1;
}
$(document).ready(function(){
removeZeros();
format();
});