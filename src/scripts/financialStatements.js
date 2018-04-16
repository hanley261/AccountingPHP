
function changeSheet(){
    document.getElementById("trial-balance-sheet").className ="hide";
    document.getElementById("income-statement-sheet").className="hide";
    document.getElementById("retained-earnings-sheet").className="hide";
    document.getElementById("balance-sheet-sheet").className="hide";

    document.getElementById(this.id+"-sheet").className = "show";
}
function setDate(){
    var d = new Date();
    var year = d.getFullYear();
    var month = d.getMonth()+1;
    month = checkDigits(month);
    var day = d.getDate();
    day = checkDigits(day);
    console.log(month +" "+ day);
    var date = document.getElementsByClassName("date");
    for(var i =0; i < date.length; i++){
        date[i].innerText = month + "/" + day + "/" + year;
    }
}
function checkDigits(num){
    if (num < 10){
        num = "0"+num;
    }
    return num;
}

function subtotalTrialBalance(){
    var subDebit = document.getElementById("trial-debit-subtotal");
    var subCredit = document.getElementById("trial-credit-subtotal");
    
    var debitNum = document.getElementsByClassName("table-debit");
    var creditNum = document.getElementsByClassName("table-credit");

    subDebit.innerText = addCollection(debitNum);
    subCredit.innerText = addCollection(creditNum);
   
}
function totalRevenue(){
    var revenue = document.getElementsByClassName("revenueGroup");
    var totalRevenue = document.getElementById("total-revenue");
    totalRevenue.innerText = addCollection(revenue); 
}
function totalExpenses(){
    var expenses = document.getElementsByClassName("ExpenesGroup");
    var totalexpense = document.getElementById("total-expenses");

    totalexpense.innerText = addCollection(expenses);
}
function totalAssets(){
    var long = document.getElementById("long-term-assets").innerText;
    var current = document.getElementById("current-assets").innerText;
    document.getElementById("total-assets").innerText = parseInt(long)+ parseInt(current);
}
function totalLTA(){
    var LTAs = document.getElementsByClassName("LTA");
    var LTA = document.getElementById("long-term-assets");
    LTA.innerText = addCollection(LTAs);
}
function totalCA(){
    var CAs = document.getElementsByClassName("CA");
    var CA = document.getElementById("current-assets");
    CA.innerText = addCollection(CAs);
}
function totalOE(){
    var OEs = document.getElementsByClassName("OE");
    var OE = document.getElementById("total-OE");
    OE.innerText = addCollection(OEs);
}
function totalLTL(){
    var LTLs = document.getElementsByClassName("LTL");
    var LTL = document.getElementById("total-LTL");
    LTL.innerText = addCollection(LTLs);
}
function addCollection(total){
    var sum=0;
    for(var i = 0; i < total.length; i++){
        sum += parseInt(total[i].innerText);
    }
    return sum;
}

$(document).ready(function(){
$("#trial-balance").click(changeSheet);
$("#income-statement").click(changeSheet);
$("#retained-earnings").click(changeSheet);
$("#balance-sheet").click(changeSheet);
setDate();
subtotalTrialBalance();
totalRevenue();
totalExpenses();
totalLTA();
totalCA();
totalAssets();
totalOE();
totalLTL();
});