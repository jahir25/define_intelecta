<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">


        <title>PANEL DEFINE</title>

        <link rel="icon" href="<?php echo base_url('public/img/favicon.ico') ?>" type="image/ico" />
        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('public/css/bootstrap.min.css?v=') . VERSION ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/bootstrap-reset.css?v=') . VERSION ?>" rel="stylesheet">

        <link href="<?php echo base_url('public/assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />

        <link rel="stylesheet" href="<?php echo base_url('public/js/jasny-bootstrap/dist/css/jasny-bootstrap.min.css')?>">
        
        <!--external css-->
        <link rel="stylesheet" href="<?php echo base_url('public/css/font-awesome.min.css') ?>">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('public/css/style.css?v=') . VERSION ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/style-responsive.css') ?>" rel="stylesheet" />


         
        <script>var baseURL = "<?php echo base_url() ?>"</script>
        <script src="<?php echo base_url('public/js/jquery.js') ?>"></script>



        <!-- CSS DATATABLES -->
        <link href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/buttons/1.3.1/css/buttons.dataTables.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
        <!-- END  CSS DATATABLES -->


        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>

          <script src="<?php echo base_url('public/js/html5shiv.js') ?>"></script>

          <script src="<?php echo base_url('public/js/respond.min.js') ?>"></script>

        <![endif]-->


        <script> var DATE_CURRENT ="<?php echo  date('d/m/Y')?>" </script>
    </head>
    <body>
     
        <div id="main-overlay"></div>

        

        <div class="container">
            <header>

                <section id="main-content">
                    <section class="wrapper">
                        <div class="row container-main">

                            <?php $this->load->view('dashboard/load_list') ?>



                        </div>
                    </section>
                </section>
            </header><!-- /header -->
            <nav id="bt-menu" class="bt-menu ">
                <a href="#" class="bt-menu-trigger"><span>Menu</span></a>
                <ul class="bt-menu-main">
                         <!-- USER ADMINISTRADOR  -->

                        <li><a class="bt-icon fa fa-users"><label>MASTER</label></a>
                            <ul class="hide">

                              


                                 <li><a class="load-view" id="loadContact" href="<?php echo base_url('index.php/master/contacto/load_list/' . $csrf_token); ?>" ><label><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> CONTACTO</label></a></li>

                                <!-- 
                                <li><a class="load-view" href="<?php echo base_url('master/users/load_list/' . $csrf_token); ?>" ><label><span class="glyphicon glyphicon-user" aria-hidden="true"></span> USUARIOS</label></a></li>
                                  -->

                            </ul>

                        </li>










                    <li>
                        <a href="javascript:void(0)"  class="bt-icon fa fa-close btn-logout"><label>SALIR</label></a>
                    </li>
                </ul>


            </nav>

        </div>

        <input type="hidden" name="token" id="token" value="<?php echo $csrf_token; ?>" />


        <!-- js placed at the end of the document so the pages load faster -->

        <script src="<?php echo base_url('public/js/bootstrap.min.js') ?>"></script>

        <script src="<?php echo base_url('public/js/bootbox.min.js') ?>"></script>
        
        <script type="text/javascript" src="<?php echo base_url('public/js/jQueryColorPicker.min.js')?>"></script> 

        <script src="<?php echo base_url('public/js/common-scripts.js?v=') . VERSION ?>"></script>
        <script src="<?php echo base_url('public/js/classie.js') ?>"></script>
        <script src="<?php echo base_url('public/js/border-menu.js') ?>"></script>
        <link rel="stylesheet" href="<?php echo base_url('public/js/jquery-ui/jquery-ui.css') ?>">

        <script src="<?php echo base_url('public/js/jquery-ui/jquery-ui.js') ?>"></script>

        <link rel="stylesheet" href="<?php echo base_url('public/js/select/bootstrap-select.css') ?>">
        <script src="<?php echo base_url('public/js/select/bootstrap-select.js') ?>"></script>

        <script src="<?php echo base_url('public/js/tinymce/tinymce.min.js') ?>"></script>
        <script src="<?php echo base_url('public/js/html5.image.preview.min.js') ?>"></script>

        <!-- JS DATATABLES -->
        
        <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url('public/js/jquery.dataTables.columnFilter.js?v=') . VERSION ?>"></script>
        <script src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/pdfmake.min.js"></script>
        <script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.27/build/vfs_fonts.js"></script>
        <script src="http://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>


        <!-- END JS DATATABLES -->





        <script src="<?php echo base_url('public/js/jasny-bootstrap/dist/js/jasny-bootstrap.min.js')?>"></script>

        <script src="<?php echo base_url('public/js/autocomplete/jquery.autocomplete.js') ?>"></script>

        <link href="<?php echo base_url('public/js/autocomplete/jquery.autocomplete.css?v=').VERSION?>" rel="stylesheet">

        <script src="<?php echo base_url('public/js/dashboard/dashboard.js?v=') . VERSION ?>"></script>

    </body>

</html>
