
<div id="" class="relative">

    <a class="load-view link-right" href="<?php echo base_url('master/' . $controller . '/load_add/' . $csrf_token . $back_parameter) ?>">
        <i class="icon-plus icon-1x icon-border" ></i>
    </a>

    <header class="panel-heading">
        Listado de Usuarios
    </header>

    <section class="panel">
        <div class="col-lg-12">

            <div class="adv-table">
                <div id="" class="dataTables_wrapper" role="grid">
                    <div class="dataTables_filter" id="">
                        <form action="<?php echo base_url('master/' . $controller . '/load_list/' . $csrf_token); ?>">
                            <label>
                                Buscar: 
                                <input type="text" class="form-control" id="searchInput" value="<?php echo $like; ?>" aria-controls="">
                            </label>
                        </form>
                    </div>
                    <table class="display table table-bordered table-striped dataTable" id="" aria-describedby="">
                        <thead>
                            <tr>
                                <th style="width: 40px">#</th>
                                <th>Usuario</th>
                                <th>Tipo</th>
                                <th>Empleado</th>
                                <th style="width: 100px"></th>
                            </tr>
                        </thead><tbody>
                            <?php
                            $items_info_count = count($items_info);



                            
                            if ($items_info_count) {
                                for ($i = 0; $i < $items_info_count; $i++) {
                                    $pattern = preg_quote($like);
                                    $_name =  ($like ==='') ?  $items_info[$i]->username:preg_replace("/($pattern)/i", '$1',$items_info[$i]->username);
                                    ?>
                                    <tr>
                                        <td><?php echo $i + 1 ?></td>
                                        <td align="center">
                                            <?php echo $items_info[$i]->username ?> 
                                        </td>
                                        <td align="center">
                                            <?php echo $items_info[$i]->type ?> 
                                        </td>
                                        <td align="center">
                                            <?php echo $items_info[$i]->name .' '.$items_info[$i]->lastname?> 
                                        </td>
                                        <td align="center">
                                            <a class="load-view btn btn-primary btn-xs" 
                                                href="<?php echo base_url('master/' . $controller . '/load_update/' . $csrf_token . '/' . $items_info[$i]->id . $back_parameter) ?>"><i class="icon-pencil icon-2x">
                                            </i>
                                        </a>
                                        <?php if ($privileges->code ==='Admin'): ?>
                                        <a class="btn delete btn-danger btn-xs" href="<?php echo base_url('master/' . $controller . '/post_delete/' . $csrf_token . '/' . $items_info[$i]->id . $back_parameter) ?>" ><i class="icon-trash icon-2x"></i></a>
                                        <?php endif;?>
                                        </td>
                                </tr>
                                <?php
                                $offset++;
                            }
                        } else {
                            ?>
                            <tr align="center">
                                <td colspan="4"><?php echo $this->lang->line('_no_results'); ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                                

                            </tr>
                        </tfoot>
                    </table>
                    <div class="dataTables_paginate paging_two_button" id="paginationBlock">
                        <?php echo $pagination; ?>
                    </div>
                </div>
            </div>


        </div>
    </section>

</div>
<script>
    var controller = '<?php echo $controller; ?>';
    var _back_url = '<?php echo $back_url ?>';
</script>
<script src="<?php echo base_url('public/js/master/' . $controller . '.js?v=').VERSION ?>"></script>