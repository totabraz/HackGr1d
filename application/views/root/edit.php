<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Usuários</strong> - <em>Editar Usuário</em>
                    </h1>
                </section>
                <hr class="col-xs-12"/>
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    $setup = array('class' => 'form-control', 'trim|required');
                    if ($msg = get_msg()) {
                        echo $msg;
                    }

                    echo form_open();

                    $form_input_name = isset($user['name']) ? $user['name'] : "";
                    
                    $form_input_cpf = isset($user['cpf']) ? $user['cpf'] : "";
                    $form_input_permission_name = isset($user['permission_name']) ? $user['permission_name'] : "";
                    $form_input_permission_value = isset($user['permission_value']) ? $user['permission_value'] : "";

                    echo ' <div class="form-group">';
                    $form_cpf = (isset($user['cpf'])) ? $user['cpf'] : '';
                    $opts = array('autocomplete' => 'off', 'name' => 'cpf', 'value' => $form_input_cpf, 'title' => 'Infome seu CPF');
                    echo form_label('CPF:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    
                    echo ' <div class="form-group">';
                    $form_name = (isset($user['name'])) ? $user['name'] : '';
                    $opts = array('autocomplete' => 'off', 'name' => 'name', 'value' => $form_input_name, 'title' => 'Infome seu Nome');
                    echo form_label('Nome:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';


                    // DADOS LOGIN 
                    echo '<div class="form-group">';
                    echo '<div class="row">';
                    echo '<div class="col-xs-12 ">';
                    echo form_label('Tipo do Usuário:');
                    echo '</div>';
                    echo '<div class="col-xs-12 ">';

                    $permission_name = array(
                        LABEL_CORRETOR => LABEL_CORRETOR,
                        LABEL_CLIENTE => LABEL_CLIENTE
                    );
                    
                    $opts = array('autocomplete' => 'off', 'name' => 'permission_name', 'value' => $form_input_permission_name, 'title' => 'Tipo de Usuário', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $permission_name, $form_input_permission_name);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';


                    echo '<div class="form-group">';
                    $opts = array('autocomplete' => 'off', 'name' => 'password', 'title' => 'Infome sua Senha', 'placeholder' => 'Senha', 'value' => '');
                    echo form_label('Senha');
                    echo '<p> <small>Deixar em branco para não editar</small></p>';
                    echo form_password($opts, '', $setup);
                    echo '</div>';

                    echo '<div class="form-group ">';
                    $opts = array('autocomplete' => 'off', 'name' => 'password2', 'title' => 'Repita sua Senha', 'placeholder' => 'Repitir Senha', 'value' => '');
                    echo form_password($opts, '', $setup);
                    echo '</div>';

                    echo '<div class="form-group ">';
                    echo form_submit('enviar', 'Salvar', array('class' => 'btn btn-success pull-right'));
                    echo '<a href="' . base_url("admin/users/listar") . '" class="btn btn-default pull-right">Voltar</a>';
                    echo '</div>';

                    // Form Closed
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- /.wrapper-content -->
<!-- fica no header -->
</div>