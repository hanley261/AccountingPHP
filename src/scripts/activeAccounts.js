var active = document.getElementById("COA-table");
var rowCount = [];
var accounts= [""];



function getAccounts(){
    rowCount =active.getElementsByTagName("tr");
    for(var i = 1; i < rowCount.length;i++){
        accounts[i] = (active.rows[i].cells[3].innerText);
    }
}

function createElement(){
    
    var select = document.getElementById("mySelect");
    for (var i = 1;  i < accounts.length; i++){
    var option = document.createElement("option");
    option.text = accounts[i];
    x.add(option);
    }
}

function haveDecimals(){
    var balance = document.getElementsByClassName("balance");
    var count;
    var count2;
    var index;
    for(var j = 0; j < balance.length; j++){
        if(balance[j].innerText != "0" ){
            if (balance[j].innerText.indexOf(".") != -1) {
                count= 0; 
                index = balance[j].innerText.indexOf(".");
                for(var i =index-1; i >0; i--){
                    count++;
                    
                    if(count >=3){
                        count =0;
                        balance[j].innerText = insertCommas(balance[j].innerText,i );
                    }
                }

            } 
            else{
                balance[j].innerText = balance[j].innerText + ".00";
                index = balance[j].innerText.indexOf(".");
                count2 = 0;
                for(var i =index-1; i >0; i--){
                    count2++;
                    
                    if(count2 >=3){
                        count2 =0;
                        balance[j].innerText = insertCommas(balance[j].innerText,i );
                    }
                }
            }
        }
    }
}
function negAndCom(number1){
    if(number1.charAt(0) == "-" && number1.charAt(1) == ","){
        number1 = number1.replace("-,","-");
    }
    return number1;
}
function insertCommas(number, index){
    var right = number.slice(index, number.length);
    var left = number.slice(0, index);
    number = left +","+right;
    number = negAndCom(number);
    return number;

}
getAccounts();
haveDecimals();