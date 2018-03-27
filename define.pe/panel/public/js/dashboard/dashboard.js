$(window).load(function() {

    $('#main-overlay').hide();
    $('#btnHome').click();

});



$(function($) {


  $('a#loadContact').click();


    $(".bt-menu").on("click", ".btn-logout", function(event) {
        event.preventDefault();
        window.location = baseURL + 'index.php/auth/auth/logout';
    });

    $.datepicker.regional['es'] = {
        closeText: 'Cerrar',
        prevText: '<Ant',
        nextText: 'Sig>',
        currentText: 'Hoy',
        monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
            'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
        dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
        dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
        dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
        weekHeader: 'Sm',
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
        isRTL: false,
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        numberOfMonths: 1,
        showMonthAfterYear: true,
        yearSuffix: ''

    };

    $.datepicker.setDefaults($.datepicker.regional['es']);


    var _t;
    $(document).on('click', '.bt-menu-main>li>a', function(e) {

        e.preventDefault();

        var _this = $(this);
        $('.bt-menu-main>li ul').removeClass('hide');
        var has = _this.closest('li').hasClass('active');

        $('.bt-menu-main>li').removeClass('active');
        if (has)
            _this.closest('li').addClass('active');

        if (_this.closest('li').hasClass('submenu-show'))
            _this.closest('li').removeClass('active');


        setTimeout(function() {
            _this.closest('li').addClass('active');

            clearTimeout(_t);
            _t = setTimeout(function() {
                $('.bt-menu-main>li').each(function() {
                    var _c = $(this);
                    if (!_c.hasClass('active'))
                    {
                        _c.find('ul').addClass('hide');
                    }
                });
            }, 200);
            $('.bt-menu-main>li').removeClass('submenu-show');
        }, 1);
    });
    $(document).on('click', '.bt-menu-main ul>li>a', function(e) {

        e.preventDefault();

        var _this = $(this);

        $('.bt-menu-main ul>li').removeClass('active');
        _this.closest('li').addClass('active');
    });



//LogoutUser();

    function LogoutUser() {


        var _timer;
        window.clearTimeout(_timer);

        _timer = setTimeout(function auth_login() {

            $.ajax({
                url: baseURL + 'auth/is_logged_ajax',
                type: 'POST',
                dataType: 'json'
            })
                    .done(function(response) {

                        if (Boolean(response.status) === true) {

                            window.location.href = response.redirect;
                        }
                    });



            setTimeout(auth_login, 20000);


        }, 20000);

    }



    /*

      Highcharts.chart('report-1', {
      chart: {
          type: 'column'
      },
      title: {
          text: 'Browser market shares. January, 2015 to May, 2015'
      },
      subtitle: {
          text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
      },
      xAxis: {
          type: 'category'
      },
      yAxis: {
          title: {
              text: 'Total percent market share'
          }

      },
      legend: {
          enabled: false
      },
      plotOptions: {
          series: {
              borderWidth: 0,
              dataLabels: {
                  enabled: true,
                  format: '{point.y:.1f}%'
              }
          }
      },

      tooltip: {
          headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
          pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
      },

      series: [{
          name: 'Brands',
          colorByPoint: true,
          data: [{
              name: 'Microsoft Internet Explorer',
              y: 56.33,
              drilldown: 'Microsoft Internet Explorer'
          }, {
              name: 'Chrome',
              y: 24.03,
              drilldown: 'Chrome'
          }, {
              name: 'Firefox',
              y: 10.38,
              drilldown: 'Firefox'
          }, {
              name: 'Safari',
              y: 4.77,
              drilldown: 'Safari'
          }, {
              name: 'Opera',
              y: 0.91,
              drilldown: 'Opera'
          }, {
              name: 'Proprietary or Undetectable',
              y: 0.2,
              drilldown: null
          }]
      }],
      drilldown: {
          series: [{
              name: 'Microsoft Internet Explorer',
              id: 'Microsoft Internet Explorer',
              data: [
                  [
                      'v11.0',
                      24.13
                  ],
                  [
                      'v8.0',
                      17.2
                  ],
                  [
                      'v9.0',
                      8.11
                  ],
                  [
                      'v10.0',
                      5.33
                  ],
                  [
                      'v6.0',
                      1.06
                  ],
                  [
                      'v7.0',
                      0.5
                  ]
              ]
          }, {
              name: 'Chrome',
              id: 'Chrome',
              data: [
                  [
                      'v40.0',
                      5
                  ],
                  [
                      'v41.0',
                      4.32
                  ],
                  [
                      'v42.0',
                      3.68
                  ],
                  [
                      'v39.0',
                      2.96
                  ],
                  [
                      'v36.0',
                      2.53
                  ],
                  [
                      'v43.0',
                      1.45
                  ],
                  [
                      'v31.0',
                      1.24
                  ],
                  [
                      'v35.0',
                      0.85
                  ],
                  [
                      'v38.0',
                      0.6
                  ],
                  [
                      'v32.0',
                      0.55
                  ],
                  [
                      'v37.0',
                      0.38
                  ],
                  [
                      'v33.0',
                      0.19
                  ],
                  [
                      'v34.0',
                      0.14
                  ],
                  [
                      'v30.0',
                      0.14
                  ]
              ]
          }, {
              name: 'Firefox',
              id: 'Firefox',
              data: [
                  [
                      'v35',
                      2.76
                  ],
                  [
                      'v36',
                      2.32
                  ],
                  [
                      'v37',
                      2.31
                  ],
                  [
                      'v34',
                      1.27
                  ],
                  [
                      'v38',
                      1.02
                  ],
                  [
                      'v31',
                      0.33
                  ],
                  [
                      'v33',
                      0.22
                  ],
                  [
                      'v32',
                      0.15
                  ]
              ]
          }, {
              name: 'Safari',
              id: 'Safari',
              data: [
                  [
                      'v8.0',
                      2.56
                  ],
                  [
                      'v7.1',
                      0.77
                  ],
                  [
                      'v5.1',
                      0.42
                  ],
                  [
                      'v5.0',
                      0.3
                  ],
                  [
                      'v6.1',
                      0.29
                  ],
                  [
                      'v7.0',
                      0.26
                  ],
                  [
                      'v6.2',
                      0.17
                  ]
              ]
          }, {
              name: 'Opera',
              id: 'Opera',
              data: [
                  [
                      'v12.x',
                      0.34
                  ],
                  [
                      'v28',
                      0.24
                  ],
                  [
                      'v27',
                      0.17
                  ],
                  [
                      'v29',
                      0.16
                  ]
              ]
          }]
      }
    });
*/




});
