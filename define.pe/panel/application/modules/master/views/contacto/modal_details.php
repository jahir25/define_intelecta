<div class="modal fade" id="modal-details">
	<div class="modal-dialog"  role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Info del Contacto</h4>
			</div>
			<div class="modal-body">
				 
				<div class="row">
                    <fieldset class="u-ligthblue">
                <legend>Modal</legend>
              
                <div class="panel-body">
                    <div class="row">
                        <div class=" col-lg-12">
                            <div class="form-group">
                                <label >Opción: <?php echo $item_info->option?></label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-12">
                            <div class="form-group">
                                <label >Nombres: <?php echo $item_info->name?></label>
                            </div>
                        </div>
                    </div>
                  
                    
                    <div class="row">
                        <div class=" col-lg-12">
                            <div class="form-group">
                                <label>Teléfono: <?php echo $item_info->phone?></label>
                                
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class=" col-lg-12">
                            <div class="form-group">
                                <label>Email: <?php echo $item_info->email?></label>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-12">
                            <div class="form-group">
                                <label>Mensaje: <?php echo $item_info->message?></label>
                                
                            </div>
                        </div>
                    </div>

                   


                </div>
            </fieldset>



                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
