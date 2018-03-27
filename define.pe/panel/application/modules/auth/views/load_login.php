<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="img/favicon.png">
        <link rel="icon" href="<?php echo base_url('public/img/favicon.png')?>" type="image/png" />
       
        <title>PANEL DEFINE</title>

        <!-- Bootstrap core CSS -->
        <link href="<?php echo base_url('public/css/bootstrap.min.css') ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/bootstrap-reset.css?v=').VERSION ?>" rel="stylesheet">
        <!--external css-->
        <link href="<?php echo base_url('public/assets/font-awesome/css/font-awesome.css') ?>" rel="stylesheet" />
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url('public/css/style.css?v=').VERSION ?>" rel="stylesheet">
        <link href="<?php echo base_url('public/css/style-responsive.css') ?>" rel="stylesheet" />
        <script>var baseURL = "<?php echo base_url() ?>"</script>
        <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'>
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
    </head>

    <body class="login-body">

        <div id="main-overlay"></div>
            <div class="main-login">

            <form class="form-signin" autocomplete="off">
                <input type="hidden" name="token" value="<?php echo $csrf_token; ?>" />
                <h2 class="form-signin-heading">
                  <img src="<?php echo base_url('public/img/logo-define.png')?>">
                </h2>
               
                 <div class="main-form">

                    <div class="form-group">
                        <label>USUARIO</label>
                        <input type="text" class="form-control" name="username"   autofocus autocomplete="off" />
                    </div>

                    <div class="form-group">
                        <label>PASSWORD</label>
                        <input type="password" class="form-control" name="password"    autocomplete="off" />
                    </div>


                      <button class="btn  btn-login btn-primary btn-block" type="submit">LOGIN <div class="loading"></div></button>
                  </div>
            </form>
            </div>

       


        <!-- js placed at the end of the document so the pages load faster -->
        <script src="<?php echo base_url('public/js/jquery.js') ?>"></script>
        <script src="<?php echo base_url('public/js/bootstrap.min.js') ?>"></script>
        <script src="<?php echo base_url('public/js/bootbox.min.js') ?>"></script>
        <script src="<?php echo base_url('public/js/auth/auth.js') ?>"></script>

    </body>
</html>
