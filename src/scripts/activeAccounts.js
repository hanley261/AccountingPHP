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
    var index;
    for(var j = 0; j < balance.length; j++){
        if (balance[j].innerText.indexOf(".") != -1) {
            count= 0; 
            index = balance[j].innerText.indexOf(".");
            console.log(index);
            for(var i =index; i >=0; i--){
                count++;
                
                if(count >=3){
                    count =0;
                    balance[j].innerText = insertCommas(balance[j].innerText,i );
                }
            }

        } 
}

    for(var i=0; j < balance.length;i++){
        var target = balance[j].innerText;

    }
}

function insertCommas(number, index){
    var left = number.slice(index, number.length);
    var right = number.slice(0, index);
    number = left +","+right;
    console.log(number);
    return number;

}
getAccounts();
haveDecimals();