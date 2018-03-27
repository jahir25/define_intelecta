
/*
var run = function() {
    var req = new XMLHttpRequest();
    req.timeout = 5000;
    req.open('GET', baseURL + 'dashboard/online/' + Common._get_csrf_token(), true);
    req.send();
}
setInterval(run, 3000);
*/
var Common = {


     _formattedDate: function() {
      var d = new Date
      var  month = String(d.getMonth() + 1);
      var  day = String(d.getDate());
      var year = String(d.getFullYear());

      if (month.length < 2) month = '0' + month;
      if (day.length < 2) day = '0' + day;

      return month +'/'+day+'/'+year;
      
    },

    _get_current_date: function() {
         var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1;  
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd='0'+dd
            } 

            if(mm<10) {
                mm='0'+mm
            } 

            today = dd+'/'+mm+'/'+yyyy;
            return today;
    },
     _get_diff_date: function(f1,f2) {
         var _f1 = f1.split('/');
            var _f2 = f2.split('/');

            var _fe1 = Date.UTC(_f1[2], _f1[1] - 1, _f1[0]);
            var _fe2 = Date.UTC(_f2[2], _f2[1] - 1, _f2[0]);
            var _dif = _fe1 - _fe2;
            var _days = Math.floor(_dif / (1000 * 6060 * 24));
            return _days;
     },


    _get_csrf_token: function() {
        return $('#token').val();
    },
    _get_overlay: function() {
        return $('#main-overlay');
    },
    _show_overlay: function () {

         Common._get_overlay().show();


        Common._get_overlay().find('.notification').addClass('no-bg').show();
    },
    _hide_overlay: function () {

         Common._get_overlay().hide();

        Common._get_overlay().find('.notification').removeClass('no-bg').hide();
      
    },
    _do_ajax: function(_url, _data, _callback_error, _callback_success) {

        var ajax_params = {};

        ajax_params.url = _url;
        ajax_params.data = _data;
        ajax_params.type = 'post';
        ajax_params.dataType = 'json';

        ajax_params.error = function(response) {
            _callback_error(response);
        };

        ajax_params.success = function(response) {
            _callback_success(response);
        };
        $.ajax(ajax_params);
    },
    _do_ajax_photo: function(_url, _data, _callback_error, _callback_success) {
        var ajax_params = {};

        ajax_params.url = _url;
        ajax_params.data = _data;
        ajax_params.type = 'post';
        ajax_params.dataType = 'json';
        
        ajax_params.contentType = false;
        ajax_params.catch = false;
        ajax_params.processData = false;



        ajax_params.error = function(response) {
            _callback_error(response);
        };

        ajax_params.success = function(response) {
            _callback_success(response);
        };
        $.ajax(ajax_params);
    },






    _build_error_message: function(_message) {
        Common._get_overlay().find('.notification').hide()
 
        bootbox.dialog({
            message: _message,
            title: "Mensaje",
            buttons: {
                danger: {
                    label: "Cerrar",
                    className: "btn-info"
                }
            }
        });
    },
     _build_success_message: function(_message) {

        Common._get_overlay().find('.notification').show();

        bootbox.dialog({
            message: _message,
            title: "Mensaje",
            buttons: {
                danger: {
                    label: "Cerrar",
                    className: "btn-danger"
                }
            }
        });
    },
    _callback_success: function(_response) {

        $('.form-group.error').removeClass('error');

        if (Boolean(_response.status) === true) {
            var _container = $('.container-main');

            if (_back_url !== '') {
                Common._load_view(_container, _back_url, false);
            }
            else {
                var _href = $('.bt-menu-main ul>li.active a').attr('href');
                Common._load_view(_container, _href, true);
            }
            


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
    },
    _callback_error: function(_response) {
        console.log(_response);
    },
    _load_view: function(_container, _href, _no_hide) {
        
        _container.load(_href, function() {

            try {

                var parsedData = JSON.parse($.trim(_container.html()));
                if (!Boolean(parsedData.status)) {
                    _container.html('');
                    location.reload();
                }

            } catch (e) {

                if (!_no_hide)
                    Common._hide_overlay();

                setTimeout(function() {
                    $('.bt-menu').removeClass('bt-menu-open');
                    $('.bt-menu-main ul').addClass('hide');
                }, 400);
            }

        });
    },
    _load: function(_url, _data, _callback_error, _callback_success) {

        var c_error = _callback_error;
        if (!_callback_error)
            c_error = Common._callback_error;

        Common._show_overlay();


        Common._do_ajax(
                _url,
                _data,
                c_error,
                _callback_success
                );
    },
    _add: function(_url, _data, _callback_error, _callback_success) {

        var c_error = _callback_error;
        if (!_callback_error)
            c_error = Common._callback_error;

        var c_success = _callback_success;
        if (!_callback_success)
            c_success = Common._callback_success;

        Common._show_overlay();


        Common._do_ajax(
                _url,
                _data,
                c_error,
                c_success
                );
    },
    _add_form: function(_url, _data, _callback_error, _callback_success) {

        var c_error = _callback_error;
        if (!_callback_error)
            c_error = Common._callback_error;

        var c_success = _callback_success;
        if (!_callback_success)
            c_success = Common._callback_success;

        Common._show_overlay();


        Common._do_ajax_photo(
                _url,
                _data,
                c_error,
                c_success
                );
    },

    _autocomplete: function(_identifier, _action, _on_select_callback, _parameters) {

        var _params = $.extend({
            token: Common._get_csrf_token()
        }, _parameters);

        $(_identifier).autocomplete({
             
            serviceUrl: _action,
            type: 'post',
            paramName: 'like',
            params: _params,
            lookupLimit:5,
            showNoSuggestionNotice: true,
            noSuggestionNotice: 'No results',
            lookupFilter: function(suggestion, originalQuery, queryLowerCase) {
                var re = new RegExp('\\b' + $.Autocomplete.utils.escapeRegExChars(queryLowerCase), 'gi');
                return re.test(suggestion.value);
            },
            onSelect: function(suggestion) {
                _on_select_callback(suggestion);
            },onSearchStart:function  (response) {
                $(_identifier).addClass('loadinggif');
            },
            onSearchComplete:function  (response) {
              $(_identifier).removeClass('loadinggif');
            
            } 
            ,noSuggestionNotice:function  (r) {
                
            }

        });

    },
    _handlebar_load_template: function(_template_identifier, _data) {

        var _source = $.trim($(_template_identifier).html());
        var _template = Handlebars.compile(_source);
        return _template(_data);

    },
    _str_pad: function(_value, _length, _string) {
        _value = $.trim(_value.toString());
        return _value.length < _length ? Common._str_pad(_string + _value, _length, _string) : _value;

    },
    _toast: function(_msg, _alert) {
        $.simplyToast(_msg, _alert);
    },
    _config_table:function(_data,_url) {
       
        var _table = {
 
                "language":{
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },

                "processing": true,  
                "serverSide": true,  
                "order": [],  

                // Load data for the table's content from an Ajax source
                "ajax": {
                    "url": _url,
                    "type": "POST",
                    "data":{
                            "date_ini": $('#date_ini').val(),
                            "date_end": $('#date_end').val()
                        },
                    complete: function() {
                        Common._hide_overlay(); 
                    },

                }


             
        };
        $.extend( _table, _data );
        return _table;
    },










    _joinObject:function (_object,_key) {
        var _item = []; 
        for (var i=0; i<_object.length; i++){
            _item.push(_object[i][_key]); 
        } 
        return _item;
    },
     _selectPicker:function  (_id) {
        if ($('#'+_id).length>0) {
            $('#'+_id).selectpicker({
                liveSearch: true,
                maxOptions: 1,
                style: 'btn-default',
                maxOptions:true
            });    
        };
        
    },
    _isValidDate:function(day,month,year) {
        var dteDate;
        month=month-1;
        dteDate=new Date(year,month,day);
        return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));

    },


    _validate_fecha:function (fecha, symbol) {
        var patron = /^(((0[1-9]|[12]\d|3[01])\/(0[13578]|1[02])\/((19|[2-9]\d)\d{2}))|((0[1-9]|[12]\d|30)\/(0[13456789]|1[012])\/((19|[2-9]\d)\d{2}))|((0[1-9]|1\d|2[0-8])\/02\/((19|[2-9]\d)\d{2}))|(29\/02\/((1[6-9]|[2-9]\d)(0[48]|[2468][048]|[13579][26])|((16|[2468][048]|[3579][26])00))))$/g;
        if(fecha.search(patron)==0)
        {
            var values=fecha.split(symbol);
           
            if(Common._isValidDate(values[0],values[1],values[2]))
            {
                return true;
            }
        }
        return false;
    },
    _restarFechas:function (f1, f2) {

        if (!Common._validate_fecha(f1))
            return false;

        if (!Common._validate_fecha(f2))
            return false;

        var _f1 = f1.split('/');
        var _f2 = f2.split('/');

        var _fe1 = Date.UTC(_f1[2], _f1[1] - 1, _f1[0]);
        var _fe2 = Date.UTC(_f2[2], _f2[1] - 1, _f2[0]);
        var _dif = _fe1 - _fe2;
        var _days = Math.floor(_dif / (1000 * 60*60 *24));

        return _days;
    },
    _calcularEdad:function (fecha) {
        
        
        if (!Common._validate_fecha(fecha))
            return false;

        var fechaActual = new Date()
        var diaActual = fechaActual.getDate();
        var mmActual = fechaActual.getMonth() + 1;
        var yyyyActual = fechaActual.getFullYear();
        FechaNac = fecha.split("/");
        var diaCumple = FechaNac[0];
        var mmCumple = FechaNac[1];
        var yyyyCumple = FechaNac[2];

        if (mmCumple.substr(0, 1) == 0) {
            mmCumple = mmCumple.substring(1, 2);
        }

        if (diaCumple.substr(0, 1) == 0) {
            diaCumple = diaCumple.substring(1, 2);
        }
        var edad = yyyyActual - yyyyCumple;

        if ((mmActual < mmCumple) || (mmActual == mmCumple && diaActual < diaCumple)) {
            edad--;
        }
        return edad;
    },
    _reIndex:function(_table) {
        var _index = 1;
        $('#' + _table + ' tbody tr').each(function () {
            var _this = $(this);
            
            _this.find('td').first().html(_index);
            _index++;
        });
    }

    


};


function replaceNumberWithCommas(yourNumber) {

    var n = yourNumber.toString().split(".");

    n[0] = n[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    return n.join(".");
}







$(function() {

  $(document).on('change', '#department_id', function () {
    Common._show_overlay();
        var _this = $(this)

        var _value = _this.val();

        if ($.trim(_value) !== '')
        {
            Common._do_ajax(
                    baseURL + 'master/location_codes/post_load_provinces',
                    {id: _value, token: Common._get_csrf_token()},
            false,
                    function (response) {
                        if (Boolean(response.status) === true) {


                            $('#province_id').html(response.html);
                            $('#district_id').html('<option value="">-- SELECCIONE --</option>');

                            Common._hide_overlay()
                        } else
                            Common._build_error_message(response.message);
                    }
            );
        }
        else
        {
            Common._hide_overlay();
            $('#province_id').html('<option value="">-- SELECCIONE --</option>');
            $('#district_id').html('<option value="">-- SELECCIONE --</option>');
        }
    });

 

    $(document).on('change', '#province_id', function () {
        Common._show_overlay();
        var _this = $(this)
        var _value = _this.val();

        if ($.trim(_value) !== '')
        {
            Common._do_ajax(
                    baseURL + 'master/location_codes/post_load_districts',
                    {id: _value, token: Common._get_csrf_token()},
            false,
                    function (response) {
                        if (Boolean(response.status) === true) {
                            $('#district_id').html(response.html);

                            Common._hide_overlay()
                        } else
                            Common._build_error_message(response.message);
                    }
            );
        }
        else
        {
            $('#district_id').html('<option value="">-- SELECCIONE --</option>');
            Common._hide_overlay();
        }

    });


  $(document).on('change', '#country_id', function () {
    Common._show_overlay();
        var _this = $(this)

        var _value = _this.val();

        if ($.trim(_value) !== '')
        {
            Common._do_ajax(
                    baseURL + 'master/location_codes/post_load_cities',
                    {id: _value, token: Common._get_csrf_token()},
            false,
                    function (response) {
                        if (Boolean(response.status) === true) {


                            $('#city_id').html(response.html);
                             

                            Common._hide_overlay();
                        } else
                            Common._build_error_message(response.message);
                    }
            );
        }
        else
        {
            $('#city_id').html('<option value="">-- SELECCIONE --</option>');
            Common._hide_overlay();
             
        }
    });
  

    $(document).on('click', '.btnAdd, .btnUpdate', function(event) {
        event.preventDefault();

        var _this = $(this);
        var _form = _this.closest('form');
        var url = _form.attr('action');
        var data = _form.serializeArray();

        Common._add(url, data);

        return false;
    });

    $(document).on('submit', '.formAdd, .formUpdate', function(event) {
        event.preventDefault();

        var _this = $(this);
        var _form = _this.closest('form');
        var url = _form.attr('action');
        
        var _data = new FormData(this);

        Common._add_form(url, _data);

        return false;
    });






    $(document).on('keydown', '.numbersOnly', function(e) {

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }

        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


    $(document).on('keydown', '.decimalOnly', function(e) {

        if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
            event.preventDefault();

        if ($(this).val().indexOf('.') !== -1 && event.keyCode == 110)
            event.preventDefault();

        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
                (e.keyCode == 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 40)) {
            return;
        }

        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });


    $(document).on('click', '#paginationBlock a', function(event) {
        event.preventDefault();

        var _this = $(this);
        var _href = _this.attr('href');
        var _container = $('.container-main');

        Common._show_overlay();


        Common._load_view(_container, _href)
    });


    var to_searchInput;
    $(document).on('keydown', '#searchInput', function(event) {

        var _this = $(this);
        var _href = _this.closest('form').attr('action');

        clearTimeout(to_searchInput);
        
        if (parseInt(event.which) === 13) {
            event.preventDefault();

            to_searchInput = setTimeout(function() {
                var _value = encodeURIComponent(_this.val());
                var _container = $('.container-main');

                _href += '/' + _value;

                Common._show_overlay();

                console.log(_href);
              
                Common._load_view(_container, _href)
            }, 1);
        }
    });


  





    $(document).on('click', '.delete', function(event) {
        event.preventDefault();
        Common._get_overlay().find('.notification').addClass('no-bg').show();

        var _this = $(this);
        bootbox.confirm(
                {
                    message: 'Estas seguro de eliminar este item?',
                    title: "Mensaje",
                    callback: function(result) {
                        if (Boolean(result) === true) {

                            var url = _this.attr('href');
                            Common._add(url, {})
                        }
                    }
                });
        $('.btn-primary').addClass('no-hide');

    });

    $(document).on('click', '.btnAnnul', function(event) {
        event.preventDefault();
        Common._get_overlay().find('.notification').addClass('no-bg').show();

        var _this = $(this);
        bootbox.confirm(
                {
                    message: 'Estas seguro de anular este documento?',
                    title: "Warning message",
                    callback: function(result) {
                        if (Boolean(result) === true) {

                            var url = _this.attr('href');
                            Common._add(url, {})
                        }
                    }
                });
        $('.btn-primary').addClass('no-hide');

    });

    


    $(document).on('click', '.load-view', function(e) {

        e.preventDefault();

         var _this = $(this);

        load_view(_this);

    });


});

function load_view(_this){

       
        var _href = _this.attr('href');

        var _container = $('.container-main');

        $('.bt-menu ul a').removeClass('active');

        _this.addClass('active');

        Common._show_overlay();


        Common._load_view(_container, _href, _this.hasClass('no-hide'))
}


   


$('body').on('click', function (e) {
    $('.btnDetailsList').each(function () {
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            $(this).popover('destroy');
        }
    });
}); 