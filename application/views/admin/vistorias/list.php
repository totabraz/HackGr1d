<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Álbuns</strong> - <em>Listagem</em>
                    </h1>
                </section>
                <hr />
                <!-- /.box-header -->

                <div class=" box-body">
                    <?php
                    if ($msg = get_msg()) {
                        echo $msg;
                    }
                    if (isset($casamentos) && sizeof($casamentos) > 0) { ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Data [A/M/D]</th>
                                    <th class="text-center">Marido</th>
                                    <th class="text-center">Esposa</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($casamentos as $single_casamento) { ?>
                                    <tr>
                                        <td class="col-xs-2"><?php if (isset($single_casamento->date_casamento)) echo $single_casamento->date_casamento ?></td>
                                        <td class="col-xs-5"><?php if (isset($single_casamento->name_marido)) echo $single_casamento->name_marido ?></td>
                                        <td class="col-xs-5"><?php if (isset($single_casamento->name_esposa)) echo $single_casamento->name_esposa ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/casamentos/editar/' . $single_casamento->ID) ?>" class="btn btn-small btn-info" title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <tfoot>
                                <tr>
                                <th class="text-center">Dia</th>
                                    <th class="text-center">Marido</th>
                                    <th class="text-center">Esposa</th>
                                    <th class="text-center">Ações</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php } else { ?>
                        <p>Nenhum album cadastrado</p>
                        <a href="<?php echo base_url('admin/casamentos/cadastrar') ?>" class="btn btn-success">Cadastrar Notícias</a>
                    <?php }  ?>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.wrapper-content -->
<!-- fica no header -->
</div>