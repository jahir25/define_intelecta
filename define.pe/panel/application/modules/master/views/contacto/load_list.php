
<div id="" class="relative">
    <header class="panel-heading">
        <i class="icon-list" ></i> LISTA DE CONTACTOS
       
    </header>

    <section class="panel">
        <div class="row">
             
            <fieldset>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label >Fecha Inicial</label>
                            <input   type="text" class="form-control" autocomplete="off" id="date_ini" name="date_ini">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                            <label >Fecha Final</label>
                            <input   type="text" class="form-control" autocomplete="off" id="date_end" name="date_end">
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="form-group">
                             <br>
                           <a href="javascript:;" class="btn btn-primary" id="btnBuscar"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></a>
                           <a href="javascript:;" class="btn btn-default" id="btnClear"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></a>
                        </div>
                    </div>
                    
            </fieldset>     


        </div>   
    
        <div class="row">
            <fieldset>
            <div class="col-lg-12">

                    <table id="tb_table" class="table table-bordered table-condensed table-hover table-responsive">
                    <thead>
                            <tr>
                                <th style="width: 40px">#</th>
                                <th>OPCIÓN</th>
                                <th>NOMBRES</th>
                                <th>TELÉFONO</th>
                                <th>EMAIL</th>
                                <th>MENSAJE</th>
                                <th>FECHA</th>
                                <th style="text-align: center;">ACCION</th>
                            </tr>
                    </thead>
                    
                    <tbody>
                    </tbody>
         
                </table>
                   

            </div>
            </fieldset>
        </div>
    </section>

</div>

<div id="main-modal"></div>



<script src="<?php echo base_url('public/js/master/' . $controller . '.js') ?>"></script>
<script>
    

$('#btnBuscar').on('click',  function(event) {
    event.preventDefault();

    if ($('#date_ini').val() =='') {
        Common._build_error_message('Ingresar Fecha Inicial');
        return false;
    }
    if ($('#date_end').val() =='') {
        Common._build_error_message('Ingresar Fecha Final');
        return false;
    }
    
 
        $('#tb_table').DataTable().destroy();
        pagination_ajax();
    



});

$('#btnClear').on('click',  function(event) {
    event.preventDefault();
    $('#date_ini').val('');
    $('#date_end').val('');

    
        $('#tb_table').DataTable().destroy();
        pagination_ajax();

});

pagination_ajax();
 


 


function pagination_ajax() {

 var _url = baseURL+'index.php/master/contacto/load_ajax'   
 


if ( $('#tb_table').length > 0) {
         
    Common._show_overlay(); 

    var _object = function(_extra) {
         return { 
             dom: 'lBfrtip',
                  buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel-o fa-2x" aria-hidden="true"></i>',
                         titleAttr: 'Exportar Excel',
                         title:  'REPORTE CONTACTOS DEFINE - '+Common._formattedDate(),
                        customize:function (xlsx) {
                         var sheet = xlsx.xl.worksheets['sheet1.xml'];
                                var numrows = 5;
                                var clR = $('row', sheet);

                                //update Row
                                clR.each(function () {
                                    var attr = $(this).attr('r');
                                    var ind = parseInt(attr);
                                    ind = ind + numrows;
                                    $(this).attr("r",ind);
                                });

                                // Create row before data
                                $('row c ', sheet).each(function () {
                                    var attr = $(this).attr('r');
                                    var pre = attr.substring(0, 1);
                                    var ind = parseInt(attr.substring(1, attr.length));
                                    ind = ind + numrows;
                                    $(this).attr("r", pre + ind);
                                });

                              function Addrow(index,data) {
                                    msg='<row r="'+index+'">'
                                    for(i=0;i<data.length;i++){
                                        var key=data[i].key;
                                        var value=data[i].value;
                                        msg += '<c t="inlineStr" r="' + key + index + '">';
                                        msg += '<is>';
                                        msg +=  '<t>'+value+'</t>';
                                        msg+=  '</is>';
                                        msg+='</c>';
                                    }
                                    msg += '</row>';
                                    return msg;
                                }

                            var r1 = Addrow(1, [{ key: 'D', value: 'REPORTE COMPRAS GENERALES ' }]);
                            var r2 = Addrow(2, [{ key: 'D', value: 'FECHA: ' }, { key: 'E', value: Common._formattedDate()}]);
                            sheet.childNodes[0].childNodes[1].innerHTML = r1 + r2+  sheet.childNodes[0].childNodes[1].innerHTML;
                        },
                          exportOptions: {
                            columns: [ 0, 1, 2, 3,4 ]
                           
                        },


                    },
                    {
                            extend: 'pdfHtml5',
                            orientation: 'portrait',
                            pageSize: 'A4',
                            text: '<i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>',
                            titleAttr: 'Exportar Pdf Vertical',
                            title:  'REPORTE DE CONTACTOS DE DEFINE - '+Common._formattedDate(),
                         
                            bProcessing: true,
                            footer: true,
                            exportOptions: {
                                columns: [ 0, 1, 2, 3,4 ]
                               
                            },
                            customize : function(doc) {

                                doc.pageMargins = [10, 10, 10,10 ]; 

                            }


                    },

                     
                ],
                

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

                },
                    "columnDefs": [
                    _extra
                        ,
                         { 'bSortable': false, 'aTargets': [ -1,0 ] }

                    ]
                
                 
            }

    };

    var _extra = {   
                     
                    targets: 7,
                    render: function ( data) {
                        
                        var link = '<div class="text-center"><a title="Imprimir"  class="btn btn-warning btn-xs btn-preview" href="javascript:;"><i class="glyphicon glyphicon-eye-open"></i></a></div>';
                            return link;
                            
                        
         
                    }
                     
                };
    
    var tb_general = $('#tb_table').DataTable(_object(_extra)); 


     $('#tb_table tbody').on( 'click', '.btn-preview', function (e) {
            e.preventDefault();
            Common._show_overlay();
          
            var data = tb_general.row( $(this).parents('tr') ).data();
            var id = data[7];


            var data =  {
                token: Common._get_csrf_token(),
                id: id
            };
            Common._do_ajax(baseURL+'index.php/master/contacto/modal_details',
                    data,
                    false,
                    function(response) {


                        if (Boolean(response.status)) {

                            $('div#main-modal').html(response.html);


                            var _modal = $("div#modal-details");
                            if (_modal.length> 0) {
                                _modal.modal(); 
                            }
                            

                            Common._hide_overlay();
                        } else {
                            Common._build_error_message(response.message);

                        }
                    }
            );

    });
}

}



</script>