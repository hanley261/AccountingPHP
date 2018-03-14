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
