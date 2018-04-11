
function hideEmptyAccounts (){
    var accounts = $(".show1");
    for(var i = 0; i < accounts.length;i++){
        if(accounts[i].getElementsByTagName("tr").length < 2){            
            accounts[i].className = "hide";  
        }
    }
}
function searchBarEmpty(){

}
function searchForAccounts(){
    
    var input, filter, tables, name;
    input = document.getElementById("search");  
    searchBarEmpty(input);
    filter = input.value.toUpperCase();   
    tables = $(".show1");
    
    for (i = 0; i < tables.length; i++) {
        name = tables[i].getElementsByClassName("table-title")[0];
        if (name.innerText.toUpperCase().indexOf(filter) > -1) {
            tables[i].style.display = "";
            
        } else {
            tables[i].style.display = "none";
            //tables[i].className = "hide"; 
           
        }
    }   
    
}

$(document).ready(function(){
    
$("#search").keyup(searchForAccounts)
hideEmptyAccounts();

});
