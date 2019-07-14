<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Vistoria</strong> - <em>Listagem</em>
                    </h1>
                </section>
                <hr class="col-xs-12" />
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if ($msg = get_msg()) { echo $msg; }
                    if (isset($vistorias) && sizeof($vistorias) > 0) { ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>CPF Cliente</th>
                                    <th>Placa</th>
                                    <th>Situação da Vistoria</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vistorias as $vistoria) { ?>
                                    <tr class="">
                                        <td><?php if (isset($vistoria->ID)) echo $vistoria->ID ?></td>
                                        <td class="col-xs-3"><?php if (isset($vistoria->cpf_cliente)) echo $vistoria->cpf_cliente ?></td>
                                        <td class="col-xs-2"><?php if (isset($vistoria->placa)) echo $vistoria->placa ?></td>
                                        <td class="col-xs-2"><?php if (isset($vistoria->status_vistoria_name)) echo $vistoria->status_vistoria_name ?></td>
                                        <td>
                                            <?php if (isset($vistoria->ID)) {
                                                $vistoriaId = $vistoria->ID;
                                            } ?>

                                            <?php if (isset($vistoria->status_vistoria_value) && $vistoria->status_vistoria_value == VALUE_SOLICITADO) { ?>
                                                <a href="<?php echo base_url('cliente/vistoria/editar/' . $vistoriaId) ?>" class="btn btn-small btn-info" title="Editar">Enviar Fotos</a>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>CPF Cliente</th>
                                    <th>Placa</th>
                                    <th>Situação da Vistoria</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                        </table>
                    <?php } else { ?>
                        <p class="col-xs-12 text-center">Sem Vistorias em aberto</p>
                    <?php } ?>
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