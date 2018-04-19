
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

    creditNum = changeCollectionNeg(creditNum);
    subDebit.innerText = addCollection(debitNum);
    subCredit.innerText = addCollection(creditNum);
   
}
function totalRevenue(){
    var revenue = document.getElementsByClassName("revenueGroup");
    var totalRevenue = document.getElementById("total-revenue");

    revenue = changeCollectionNeg(revenue);
    totalRevenue.innerText = addCollection(revenue); 
}
function totalExpenses(){
    var expenses = document.getElementsByClassName("ExpenesGroup");
    var totalexpense = document.getElementById("total-expenses");

    totalexpense.innerText = addCollection(expenses);
}
function netProfit(){
    var revenue = document.getElementsByClassName("revenueGroup");
    var totalRevenue = document.getElementById("total-revenue");

    var expenses = document.getElementsByClassName("ExpenesGroup");
    var totalexpense = document.getElementById("total-expenses");

    totalexpense = addCollection(expenses);
    totalRevenue = addCollection(revenue); 
    
    document.getElementById("net-profit").innerText = (totalRevenue - totalexpense);
    console.log(document.getElementById("net-profit").innerText);
    document.getElementById("retained-earnings-value").innerText = document.getElementById("net-profit").innerText;
    
  
    
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
    OEs = changeCollectionNeg(OEs);
    OE.innerText = addCollection(OEs);
}
function totalLTL(){
    var LTLs = document.getElementsByClassName("LTL");
    var LTL = document.getElementById("total-LTL");

    LTLs = changeCollectionNeg(LTLs);
    LTL.innerText = addCollection(LTLs);
}
function totalCL(){
    var CLs = document.getElementsByClassName("CL");
    var CL = document.getElementById("total-CL");

    CLs = changeCollectionNeg(CLs);
    CL.innerText = addCollection(CLs);
}
function totalELTLCL(){
    var LTLs = document.getElementsByClassName("LTL");
    var LTL = document.getElementById("total-LTL");

    var OEs = document.getElementsByClassName("OE");
    var OE = document.getElementById("total-OE");

    var CLs = document.getElementsByClassName("CL");
    var CL = document.getElementById("total-CL");

    CL = addCollection(CLs);
    OE = addCollection(OEs);
    LTL= addCollection(LTLs);

    document.getElementById("total-EL").innerText = (CL +OE+LTL);

}
function addCollection(total){
    var sum=0;
    for(var i = 0; i < total.length; i++){
        sum += parseInt(total[i].innerText);
    }
    sum = makeNumPositive(sum);
    return sum;
}
function changeCollectionNeg(collection){
    for(var i = 0; i < collection.length;i++){
        collection[i].innerText = makeNumPositive(parseInt(collection[i].innerText));
    }
    return collection;
}
function makeNumPositive(number){
    return Math.abs(number);
}
function addRetained(){
    totalEL = document.getElementById("total-EL");
    totalEL.innerText = parseInt(totalEL.innerText) +parseInt(document.getElementById("retained-earnings-value").innerText);
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
totalCL();
totalELTLCL();
netProfit();
addRetained();
});