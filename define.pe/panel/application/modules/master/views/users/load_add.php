<div  class="relative">

    <a class="load-view link-right btn-back" href="<?php echo $back_url; ?>">
        <i class="icon-reply icon-1x icon-border"></i>
    </a>

    <header class="panel-heading">
        <strong>REGISTRAR USUARIO</strong>
    </header>


    <section class="panel u-ligthblue">
        <form role="form" autocomplete="off" action="<?php echo base_url('master/' . $controller . '/post_add') ?>">
            <input type="hidden" name="token" id="token" value="<?php echo $csrf_token; ?>" />

            <fieldset class="u-ligthblue">
                <legend>Datos del Usuario</legend>
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-lg-3">
                            <div class="form-group">
                                <label for="name">Nombre (*)</label>
                                <input type="text" class="form-control" autocomplete="off" id="name" name="name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-6">
                            <div class="form-group">
                                <label for="name">Apellidos (*)</label>
                                <input type="text" class="form-control" autocomplete="off" id="lastname" name="lastname">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input  type="text" maxlength="8" class=" form-control numbersOnly" name="dni" id="dni">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class=" col-lg-2">
                            <div class="form-group">
                                <label for="phone">Tel&eacute;fono</label>
                                <input maxlength="20" type="text" name="phone" class="numbersOnly form-control" id="phone">
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class=" col-lg-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input  type="text" name="email" class="form-control" id="email">
                            </div>
                        </div>
                    </div>



                </div>
            </fieldset>
            <br>
            <fieldset>
                <legend>DATOS DE ACCESO</legend>
                <div class="row">
                    <div class=" col-lg-3">
                        <div class="form-group">
                            <label for="user_group_id">Tipo Usuario</label>
                            <select class="form-control" name="user_group_id" id="user_group_id">
                                <?php echo $user_groups ?>
                            </select>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-lg-3">
                        <div class="form-group">
                            <label for="username">Usuario</label>
                            <input  type="text" name="username" class="form-control" id="username">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class=" col-lg-6">
                        <div class="form-group">
                            <label for="username">Password</label>
                            <input  type="text" name="password" class="form-control" id="password">
                        </div>
                    </div>
                </div>
            </fieldset>
            <br>
           

        
 
      <div class="panel-body align-right">         
                <div class="row">
                    <button type="submit" class="btn btn-danger btnAdd"><i class="icon-save icon-2x"></i></button>
                </div>
            </div>
 

          

        </form>
    </section>
</div>


<script>

    var controller = '<?php echo $controller; ?>';
    var _back_url = '<?php echo $back_url ?>';

</script>

 
    <script src="<?php echo base_url('public/js/master/' . $controller . '.js?v=').VERSION ?>"></script>
 
