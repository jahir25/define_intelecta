$(window).load(function () {
    $('#main-overlay').hide();
});

$(function () {



$('.btnAddContri').on('click', function(event) {
	event.preventDefault();
	var _this = $(this);
	var _form = _this.closest('form');
	Common._get_overlay().show();
	var _url = baseURL + 'planilla/contributions/post_add';
	var _data= _form.serializeArray();
	Common._do_ajax(_url, _data, function (_response) {
		console.log(_response)
	},
	function (_response) {
		if (Boolean(_response.status) === true) {
			Common._get_overlay().hide();
		} else {
			Common._build_error_message(_response.message);
			Common._get_overlay().hide();
		}
	}
	);
});























	$('.p-input').on('keyup', function(event) {
		
		getTotal();
	});

	if ($('table').length>0) {
		getTotal();	
	}
	

	
	function getTotal () {
		var total = 0;
		var item = $('table').find('tbody .item');

		$.each(item, function(index, val) {
			var _this = $(this);
			var input = _this.find('.p-input');
			total = 0;
			$.each(input, function(index, val) {
				var elem = $(this);
				if ($.trim(elem.val()) !=='') 
					total += parseFloat(elem.val());	

				
				
			});
			_this.find('.total').val(total.toFixed(2));

		});

	};



});


