
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Vistoria</strong> - <em>Cadastrar Nova</em>
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

                    $form_input_cpf_cliente = isset($form_input['cpf_cliente']) ? $form_input['cpf_cliente'] : "";
                    echo ' <div class="form-group">';
                    $cpf_corretor = (isset($user['cpf_corretor'])) ? $user['cpf_corretor'] : '';
                    $opts = array('name' => 'cpf_corretor', 'value' => $cpf_corretor, 'title' => 'Infome seu CPF', 'id' => "cpf_corretor");
                    echo form_label('CPF do Corretor:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';
                    
                    
                    echo ' <div class="form-group">';
                    $cpf_cliente = (isset($user['cpf_cliente'])) ? $user['cpf_cliente'] : '';
                    $opts = array('name' => 'cpf_cliente', 'value' => $cpf_cliente, 'title' => 'Infome seu CPF', 'id' => "id_cpf_cliente");
                    echo form_label('CPF do Cliente:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';
                    
                    echo ' <div class="form-group">';
                    $placa = (isset($user['placa'])) ? $user['placa'] : '';
                    $opts = array('name' => 'placa', 'value' => $placa, 'title' => 'Infome seu CPF', 'id' => "id_placa");
                    echo form_label('Placa do Veículo:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';
                 

                    echo ' <div class="form-group">';
                    $renavam = (isset($user['renavam'])) ? $user['renavam'] : '';
                    $opts = array('name' => 'renavam', 'value' => $renavam, 'title' => 'Infome seu CPF', 'id' => "id_renavam");
                    echo form_label('Renavam do Veículo:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';
            

                    echo ' <div class="form-group">';
                    $chassi = (isset($user['chassi'])) ? $user['chassi'] : '';
                    $opts = array('name' => 'chassi', 'value' => $chassi, 'title' => 'Infome seu CPF', 'id' => "id_chassi");
                    echo form_label('Chassi do Veículo:');
                    echo form_input($opts, '', $setup);
                    echo '</div>';
                

                    echo '<div class="row">';
                    echo '<div class="col-xs-12">';
                    echo '<div class="form-group">';
                    echo '<div class="row">';
                    echo '<div class="col-xs-12 ">';
                    echo form_label('Situação da Visstoria:');
                    echo '</div>';
                    echo '<div class="col-xs-12 ">';
                    $status_vistoria_name = array(
                        LABEL_NAO_SOLICITADO => LABEL_NAO_SOLICITADO,
                        LABEL_SOLICITADO => LABEL_SOLICITADO
                    );
                    $selected = ($this->input->post('status_vistoria_name')) ? $this->input->post('status_vistoria_name') : LABEL_NAO_SOLICITADO;
                    $opts = array('autocomplete' => 'off', 'name' => 'status_vistoria_name', 'value' => $selected, 'title' => 'Tipo de Usuário', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $status_vistoria_name, $selected);
                    echo '</div>';
                    echo '</div>';
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