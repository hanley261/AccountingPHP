
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
    document.getElementById("retained-earnings-value").innerText = document.getElementById("net-profit").innerText; 
    document.getElementById("add-net").innerText = document.getElementById("net-profit").innerText; 
}
function totalAssets(){
    var long = document.getElementById("long-term-assets");
    var current = document.getElementById("current-assets");
    var totalAss =document.getElementById("total-assets");
     totalAss.innerText = Number(long.innerText)+ Number(current.innerText);
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

    document.getElementById("total-EL").innerText =(CL +OE+LTL);
}
function addCollection(total){
    var sum=0;
    for(var i = 0; i < total.length; i++){
        sum += Number(total[i].innerText);
    }
    sum = makeNumPositive(sum);
    return sum;
}
function changeCollectionNeg(collection){
    for(var i = 0; i < collection.length;i++){
        collection[i].innerText = makeNumPositive(Number(collection[i].innerText));
    }
    return collection;
}
function makeNumPositive(number){
    return Math.abs(number);
}
function addRetained(){
    totalEL = document.getElementById("total-EL");
    totalEL.innerText = Number(totalEL.innerText) +Number(document.getElementById("retained-earnings-value").innerText);
    
    
}
function finalize(){
    var LTLs = document.getElementsByClassName("LTL");
    var LTL = document.getElementById("total-LTL");

    var OEs = document.getElementsByClassName("OE");
    var OE = document.getElementById("total-OE");

    var CLs = document.getElementsByClassName("CL");
    var CL = document.getElementById("total-CL");
    var subDebit = document.getElementById("trial-debit-subtotal");
    var subCredit = document.getElementById("trial-credit-subtotal");
    
    var debitNum = document.getElementsByClassName("table-debit");
    var creditNum = document.getElementsByClassName("table-credit");

    var revenue = document.getElementsByClassName("revenueGroup");
    var totalRevenue = document.getElementById("total-revenue");

    var expenses = document.getElementsByClassName("ExpenesGroup");
    var totalexpense = document.getElementById("total-expenses");

    var CAs = document.getElementsByClassName("CA");
    var CA = document.getElementById("current-assets");

    var LTAs = document.getElementsByClassName("LTA");
    var LTA = document.getElementById("long-term-assets");

    var totalEL = document.getElementById("total-EL");
    var retainedEarnings = document.getElementById("retained-earnings-value");
    var totalAss =document.getElementById("total-assets");
    var netProfit = document.getElementById("net-profit");
    var OE = document.getElementById("total-OE");
    OE.innerText = Number(OE.innerText) + Number(retainedEarnings.innerText);

    loopCFD(debitNum);
    loopCFD(creditNum);
    loopCFD(CLs);
    loopCFD(OEs);
    loopCFD(LTLs);
    loopCFD(revenue);
    loopCFD(expenses);
    loopCFD(CAs);
    loopCFD(LTAs);

    addDollar(netProfit);
    addDollar(totalAss);
    addDollar(retainedEarnings);
    addDollar(totalEL);
    addDollar(CA);
    addDollar(LTA);
    addDollar(CL);
    addDollar(LTL);
    addDollar(OE);
    addDollar(subCredit);
    addDollar(subDebit);
    addDollar(totalRevenue);
    addDollar(totalexpense);

    addYear();
    totalSRE();
}
function totalSRE(){
    var prev = document.getElementById("prev-retained");
    var current = document.getElementById("add-net");
    var total = document.getElementById("retained-total");
    var div = document.getElementById("Dividends");
    total.innerText = Number(prev.innerText) + Number(current.innerText) + Number(Dividends.innerText);
    
    prev.innerText = Number(prev.innerText);
    div.innerText = Number(div.innerText);
    
    addDollar(prev);
    addDollar(current);
    addDollar(total);
    addDollar(div);
}
function addYear(){
    var d = new Date();
    var year = d.getFullYear();
    var placeholder = document.getElementsByClassName("this-year");
    for(var i = 0; i < placeholder.length; i++){
        placeholder[i].innerText = year;
    }
}
function addDollar(element){
        checkForDecimal(element);
        if(element.id != "retained-earnings-value"){
            element.innerText = "$ " +element.innerText;
        }
    
}
function loopCFD(collection){
    for(var i= 0;i < collection.length;i++ ){
        checkForDecimal(collection[i]);
        if(i == 0){
            collection[i].innerText = "$ " + collection[i].innerText;
        }
    }
}
function checkForDecimal(element){
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
finalize();
});