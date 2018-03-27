$(function() {

    $('.btnUpdateSettings').on('click', function(event) {

        Common._get_overlay().show();

        event.preventDefault();

        var _this = $(this);
        var _form = _this.closest('form');
        var url = _form.attr('action');
        var data = _form.serializeArray();

        Common._add(url, data, false, function(_response) {

            $('.form-group.error').removeClass('error');

            if (Boolean(_response.status) === true) {

               
               Common._build_success_message(_response.message);


            } else {
                Common._build_error_message(_response.message);

                var _input = $(_response.id);

                if (_input.length === 1)
                {
                    _input.closest('.form-group').addClass('error');

                    _input.focus();
                    _input.select();

                    jQuery('body,html').animate({
                        scrollTop: _input.offset().top - 50
                    }, 500);
                }
            }

        });

    });
});