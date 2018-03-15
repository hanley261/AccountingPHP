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
getAccounts();