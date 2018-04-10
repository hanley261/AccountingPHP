
function hideEmptyAccounts (){
    var accounts = $(".show");
    for(var i = 0; i < accounts.length;i++){
        if(accounts[i].getElementsByTagName("tr").length < 2){            
            accounts[i].style.display = "none";    
        }
    }
}

hideEmptyAccounts();