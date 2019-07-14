<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Usuários</strong> - <em>Cadastrar Novo</em>
                    </h1>
                </section>
                <hr class="col-xs-12" />
                <div class="box-body">
                    <?php
                    $setup = array('class' => 'form-control', 'trim|required');
                    if ($msg = get_msg()) {

                        echo $msg;
                        
                    }
                    echo form_open();

                    $form_input_name = isset($form_input['name']) ? $form_input['name'] : "";
                    $form_input_cpf = isset($form_input['cpf']) ? $form_input['cpf'] : "";

                    echo ' <div class="form-group">';
                    $form_cpf = (isset($user['cpf'])) ? $user['cpf'] : '';
                    $opts = array('name' => 'cpf', 'value' => $form_input_cpf, 'title' => 'Infome seu CPF', 'id' => "cpf_form");
                    echo form_label('cpf:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $form_name = (isset($user['name'])) ? $user['name'] : '';
                    $opts = array('name' => 'name', 'value' => $form_input_name, 'title' => 'Infome seu Nome', 'id' => "name_form");
                    echo form_label('Nome:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';


                    echo '<div class="row">';
                    echo '<div class="col-xs-12">';

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

                    $selected = ($this->input->post('permission_name')) ? $this->input->post('permission_name') : LABEL_CLIENTE;
                    $opts = array('autocomplete' => 'off', 'name' => 'permission_name', 'value' => $selected, 'title' => 'Tipo de Usuário', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $permission_name, $selected);
                    echo '</div>';

                    echo '</div>';
                    echo '</div>';


















                    echo '<div class="form-group">';
                    $opts = array('name' => 'password', 'title' => 'Infome sua Senha', 'placeholder' => 'Senha', 'value' => 'poipoipoi');
                    echo form_label('Senha');
                    echo form_password($opts, '', $setup);
                    echo '</div>';

                    echo '<div class="form-group ">';
                    echo form_label('Repetir Senha');
                    $opts = array('name' => 'password2', 'title' => 'Repita sua Senha', 'placeholder' => 'Repitir Senha', 'value' => 'poipoipoi');
                    echo form_password($opts, '', $setup);
                    echo '</div>';



                    echo '<div class="form-group text-right">';
                    echo form_label('Adicionar Outro &nbsp;');
                    echo form_checkbox('addmore', 'Adicionar Outro',  TRUE);
                    echo '</div>';

                    echo form_submit('enviar', 'Salvar', array('class' => 'btn btn-success pull-right'));
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