<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-6">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Vistoria</strong> - <em>Editar</em>
                    </h1>
                </section>
                <hr class="col-xs-12" />
                <!-- /.box-header -->
                <div class="box-body">
                    <?php
                    $setup = array('class' => 'form-control', 'trim|required');
                    if ($msg = get_msg()) {
                        echo $msg;
                    }

                    echo form_open();
                    $form_input_cpf_cliente = isset($form_input['cpf_cliente']) ? $form_input['cpf_cliente'] : "";


                    echo ' <div class="form-group">';
                    $date_vistoria = (isset($vistorias['date_vistoria'])) ? $vistorias['date_vistoria'] : '';
                    $opts = array('name' => 'date_vistoria', 'value' => $date_vistoria, 'title' => 'Data da vistoria', 'id' => "id_date_vistoria");
                    echo form_label('Data da vistoria:');
                    echo '<p>' . $date_vistoria . '</p>';
                    echo '</div>';


                    echo ' <div class="form-group">';
                    $cpf_corretor = (isset($vistorias['cpf_corretor'])) ? $vistorias['cpf_corretor'] : '';
                    $opts = array('name' => 'cpf_corretor', 'value' => $cpf_corretor, 'title' => 'Infome seu CPF', 'id' => "cpf_corretor");
                    echo form_label('CPF do Corretor:');
                    echo '<p>' . $cpf_corretor . '</p>';
                    echo '</div>';


                    echo ' <div class="form-group">';
                    $cpf_cliente = (isset($vistorias['cpf_cliente'])) ? $vistorias['cpf_cliente'] : '';
                    $opts = array('name' => 'cpf_cliente', 'value' => $cpf_cliente, 'title' => 'Infome seu CPF', 'id' => "id_cpf_cliente");
                    echo form_label('CPF do Cliente:');
                    echo '<p>' . $cpf_cliente . '</p>';
                    echo '</div>';

                    echo ' <div class="form-group">';
                    $placa = (isset($vistorias['placa'])) ? $vistorias['placa'] : '';
                    $opts = array('name' => 'placa', 'value' => $placa, 'title' => 'Infome seu CPF', 'id' => "id_placa");
                    echo form_label('Placa do Veículo:');
                    echo '<p>' . $placa . '</p>';
                    echo '</div>';


                    echo ' <div class="form-group">';
                    $renavam = (isset($vistorias['renavam'])) ? $vistorias['renavam'] : '';
                    $opts = array('name' => 'renavam', 'value' => $renavam, 'title' => 'Infome seu CPF', 'id' => "id_renavam");
                    echo form_label('Renavam do Veículo:');
                    echo '<p>' . $renavam . '</p>';
                    echo '</div>';


                    echo ' <div class="form-group">';
                    $chassi = (isset($vistorias['chassi'])) ? $vistorias['chassi'] : '';
                    $opts = array('name' => 'chassi', 'value' => $chassi, 'title' => 'Infome seu CPF', 'id' => "id_chassi");
                    echo form_label('Chassi do Veículo:');
                    echo '<p>' . $chassi . '</p>';
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
                        LABEL_CONFIRMADO => LABEL_CONFIRMADO,
                        LABEL_SOLICITADO => LABEL_SOLICITADO,
                        LABEL_NEGADO => LABEL_NEGADO




                    );
                    $selected = ($this->input->post('status_vistoria_name')) ? $this->input->post('status_vistoria_name') : LABEL_NAO_SOLICITADO;
                    $opts = array('autocomplete' => 'off', 'name' => 'status_vistoria_name', 'value' => $selected, 'title' => 'Tipo de Usuário', 'class' => 'form-control editorhtml col');
                    echo form_dropdown($opts, $status_vistoria_name, $selected);
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';


                    // ===============================================================
                    // ====================== ADD FILE 1 IMAGEM ======================
                    // ===============================================================
                    ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="custom-file row">
                                        <label class="col-xs-12 custom-file-label" for="imgFormInput1">Imagem 1: Frente do veículo</label>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($img1) && $img1 != '') { ?>
                                <figure class="col-xs-12">
                                    <img src="<?php echo base_url('uploads/') . $img1; ?>" style="width:100px; height:100px;" />
                                </figure>
                            <?php } else { ?>
                                <p class="col-xs-12"><strong>Aguardando..</strong> Imagem não enviada</p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php

                    // ===============================================================
                    // ====================== ADD FILE 2 IMAGEM ======================
                    // ===============================================================
                    ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="custom-file row">
                                        <label class="col-xs-12 custom-file-label" for="imgFormInput2">Imagem 2: Costas do veículo</label>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($img2) && $img2 != '') { ?>
                                <figure class="col-xs-12">
                                    <img src="<?php echo base_url('uploads/') . $img2; ?>" style="width:100px; height:100px;" />
                                </figure>
                            
                            <?php } else { ?>
                                <p class="col-xs-12"><strong>Aguardando..</strong> Imagem não enviada</p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php


                    // ===============================================================
                    // ====================== ADD FILE 3 IMAGEM ======================
                    // ===============================================================
                    ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="custom-file row">
                                        <label class="col-xs-12 custom-file-label" for="imgFormInput3">Imagem 3: Lado esquerdo do veículo</label>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($img3) && $img3 != '') { ?>
                                <figure class="col-xs-12">
                                    <img src="<?php echo base_url('uploads/') . $img3; ?>" style="width:100px; height:100px;" />
                                </figure>
                            
                            <?php } else { ?>
                                <p class="col-xs-12"><strong>Aguardando..</strong> Imagem não enviada</p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php


                    // ===============================================================
                    // ====================== ADD FILE 4 IMAGEM ======================
                    // ===============================================================
                    ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="input-group">
                                    <div class="custom-file row">
                                        <label class="col-xs-12 custom-file-label" for="imgFormInput4">Imagem 4: Lado direito do veículo</label>
                                    </div>
                                </div>
                            </div>
                            <?php if (isset($img4) && $img4 != '') { ?>
                                <figure class="col-xs-12">
                                    <img src="<?php echo base_url('uploads/') . $img4; ?>" style="width:100px; height:100px;" />
                                </figure>
                            
                            <?php } else { ?>
                                <p class="col-xs-12"><strong>Aguardando..</strong> Imagem não enviada</p>
                            <?php } ?>
                        </div>
                    </div>
                    <?php

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