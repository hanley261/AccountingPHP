

/*
Calendar
*/
var date = new Date();
var month = date.getMonth()+1;
var day = date.getDate();
var today = (month<10 ? '0' : '') + month + '/'+ (day<10 ? '0' : '') + day +'/' + date.getFullYear();
    
$('#datepicker').datepicker({
    uiLibrary: 'bootstrap4',
    minDate: today
});

jQuery.validator.setDefaults({
    debug: true,
    success: "valid"
  });
  $( "#datepicker" ).validate({
    rules: {
      field: {
        required: true,
        date: true
      }
    }
  });


/*
Table functions 
*/
function addRow(){
  $(".layoutRow").clone().insertAfter(".layoutRow");
  var rows = $(".layoutRow");
  rows[1].className = "target";

}

function addDebit(){
  console.log("hello");
  alert("test");

}
function setDate(){
  var newDate = $('.dateSet');
  for(var i = 0; i < newDate.length;i++){
  newDate[i].value = document.getElementById("datepicker").value;
  } 
}

$("#JEtable").on('click','span',function(){
  $(this).after('<br/><input type="number" step="0.01" value="0.00" min = "0" name="debit"><span class= "addDebit">+</span>');
  $(this).nextUntil("input").before("<br/>");
  $(this).parent().next().children("input").before("<br/><br/><br/>");
  setDate();
});

$(document).ready(function(){
  $("#addAccount").click(addRow);
  $("#addAccount").click(setDate);
  $("#datepicker").change(setDate);
  
  });

  $('#submitAll').click(function(){
    $('.target').each(function(){
        $(this).find("form").submit();
    });
});