$(function () {
	
		$("#date_ini").datepicker({
	        defaultDate: "+1w",
	        changeMonth: true,
	        numberOfMonths: 3,
	        dateFormat: 'yy-mm-dd',
	        onClose: function (selectedDate) {
	            $("#date_end").datepicker("option", "minDate", selectedDate);
	        }
	    });
	    $("#date_end").datepicker({
	        defaultDate: "+1w",
	        changeMonth: true,
	        numberOfMonths: 3,
	        dateFormat: 'yy-mm-dd',
	        onClose: function (selectedDate) {
	            $("#date_ini").datepicker("option", "maxDate", selectedDate);
	        }
	    });	
 
  
});