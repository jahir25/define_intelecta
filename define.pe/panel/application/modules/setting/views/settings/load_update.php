

<div id="slider_container" class="relative">



    <header class="panel-heading">
        <i class="icon-pencil"></i> Configuraci&oacute;n General
    </header>


    <section class="panel">
        <form role="form" autocomplete="off" action="<?php echo base_url('setting/' . $controller . '/post_update') ?>">
            <input type="hidden" name="token" id="token" value="<?php echo $csrf_token; ?>" />

            <input type="hidden" value="<?php echo $item_info->id ?>" name="id" id="id" />
            <fieldset>
                <legend>INFORMACI&Oacute;n POS</legend>
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-lg-2">
                            <div class="form-group">
                                <label for="tax">I.G.V (%) ACTUAL</label>
                                <input value="<?php echo $item_info->tax ?>" type="text" class="form-control numbersOnly" autocomplete="off" id="tax" name="tax">
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-lg-4">
                            <fieldset>
                                <legend>FACTURA</legend>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="serie-factura">Nº Serie</label>
                                            <input value="<?php echo $item_info->serie_factura ?>" type="text" class="form-control" id="serie_factura" name="serie_factura">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-lg-4">
                            <fieldset>
                                <legend>BOLETA</legend>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="serie-boleta">Nº Serie</label>
                                            <input value="<?php echo $item_info->serie_boleta ?>" type="text" class="form-control" id="serie_boleta" name="serie_boleta" >
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-lg-4">
                            <fieldset>
                                <legend>TICKET</legend>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="serie-ticket">Nº Serie</label>
                                            <input value="<?php echo $item_info->serie_ticket ?>" type="text" class="form-control" id="serie_ticket" name="serie_ticket">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>



                </div>
            </fieldset>


            <fieldset>
                <legend>INFORMACI&Oacute;N TICKETERA</legend>
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-lg-2">
                            <div class="form-group">
                                
                                <label for="code_ticketera">C&oacute;digo de Ticketera</label>
                                <input value="<?php echo $item_info->code_ticketera ?>"  type="text" class="form-control" autocomplete="off" id="code_ticketera" name="code_ticketera">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <legend>INFORMACI&Oacute;N EMPRESA</legend>
                <div class="panel-body">

                    <div class="row">
                        <div class=" col-lg-10">
                            <div class="form-group">
                                <label for="company">Empresa</label>
                                <input value="<?php echo $item_info->company ?>"   type="text" class="form-control" autocomplete="off" id="company" name="company">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-3">
                            <div class="form-group">
                                <label for="ruc">Ruc</label>
                                <input value="<?php echo $item_info->ruc ?>"   type="text" class="form-control numbersOnly" autocomplete="off" id="ruc" name="ruc">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-6">
                            <div class="form-group">
                                <label for="manager">Gerente</label>
                                <input value="<?php echo $item_info->manager ?>"   type="text" class="form-control" autocomplete="off" id="manager" name="manager">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-12">
                            <div class="form-group">
                                <label for="address">Direcci&oacute;n</label>
                                <input  value="<?php echo $item_info->address ?>"  type="text" class="form-control" autocomplete="off" id="address" name="address">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-3">
                            <div class="form-group">
                                <label for="phone">Tel&eacute;fono</label>
                                <input  value="<?php echo $item_info->phone ?>"  type="text" class="form-control numbersOnly" autocomplete="off" id="phone" name="phone">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <div class="panel-body align-right">         
                <div class="row">
                    <button type="submit" class="btn btn-danger btnUpdateSettings"><i class="icon-save icon-2x"></i></button>
                </div>
            </div>
        </form>
    </section>
</div>
<script src="<?php echo base_url('public/js/setting/' . $controller . '.js') ?>"></script>







