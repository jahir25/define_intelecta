
$(window).load(function() {
    $('#main-overlay').hide();
});

$(function($) {
    $(".btn-login").on("click", function(event) {
        $('#main-overlay').show();

        event.preventDefault();

        var _this = $(this);
        var _form = _this.closest('form');
        var url = baseURL + "index.php/auth/post_login";

        var data = _form.serializeArray();

        var ajax_params = {};

        ajax_params.url = url;
        ajax_params.data = data;
        ajax_params.type = 'post';
        ajax_params.dataType = 'json';

        ajax_params.error = function(response) {
            console.log(response);
        };
        ajax_params.success = function(response) {
            if (Boolean(response.status) === true) {
                window.location = 'index.php/dashboard'
            } else {
                $('#main-overlay').addClass('no-bg');
                
                bootbox.dialog({
                    message: response.message,
                    title: "Mensaje",
                    buttons: {
                        warning: {
                            label: "Cerrar",
                            className: "btn-info"
                        }
                    }
                });
            }
        };
        $.ajax(ajax_params);
    });
});