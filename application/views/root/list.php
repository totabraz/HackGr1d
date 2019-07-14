<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Usuários</strong> - <em>Listagem</em>
                    </h1>
                </section>
                <hr class="col-xs-12" />
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    if ($msg = get_msg()) {
                        echo $msg;
                    }
                    if (isset($users) && sizeof($users) > 0) { ?>

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    
                                    <th>Tipo Usuário</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $index = true ?>
                                <?php foreach ($users as $user) { ?>
                                    <?php if ($index) { } ?>
                                    <tr class="">
                                        <td><?php if (isset($user->name)) echo $user->name ?></td>
                                        <td><?php if (isset($user->cpf)) echo $user->cpf ?></td>
                                        <td><?php if (isset($user->permission_name)) echo $user->permission_name ?></td>

                                        <td>
                                            <?php if (isset($user->ID)) {
                                                $userId = $user->ID;
                                                
                                            } ?>

                                            <a href="<?php echo base_url('root/editar/' . $userId) ?>" class="btn btn-small btn-info" title="Editar">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <tfoot>
                                <tr>
                                    <th>Nome</th>
                                    <th>Login</th>
                                    <th>Tipo Usuário</th>
                                    <th>Ações</th>
                                </tr>
                            </tfoot>
                        </table>
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