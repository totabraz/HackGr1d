<section class="content">
    <div class="row">
        <div class="col-xs-12 col-dm-10 col-md-8 col-lg-6 ">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center"> <strong class="text-uppercase">Setup</strong></h1>
                </section>
                <hr class="" />
                <!-- /.box -->
                <div class="box-body">
                    <?php if ($msg = get_msg()) echo $msg; ?>
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $setup = array('class' => 'form-control', 'trim|required');

                                if ($msg = get_msg()) {
                                    echo $msg;
                                }

                                echo form_open();

                                echo '<div class="form-group">';
                                // echo "<hr/>";
                                echo form_label('Tipo do usuário: ROOT');
                                echo '</div>';

                                echo ' <div class="form-group">';
                                $form_cpf = (isset($user['cpf'])) ? $user['cpf'] : '';
                                $opts = array('name' => 'cpf', 'value' => $form_cpf, 'title' => 'Infome seu E-mail', 'id' => "cpf_form");
                                echo form_label('cpf:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';

                                echo ' <div class="form-group">';
                                $form_name = (isset($user['name'])) ? $user['name'] : '';
                                $opts = array('name' => 'name', 'value' => $form_name, 'title' => 'Infome seu Nome', 'id'=>'name_form');
                                echo form_label('Nome:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';

                                echo '<div class="form-group">';
                                $opts = array('name' => 'password', 'title' => 'Infome sua Senha', 'placeholder' => 'Senha', 'value' => 'poipoipoi');
                                echo form_label('Senha');
                                echo form_password($opts, '', $setup);
                                echo '</div>';

                                echo '<div class="form-group">';
                                $opts = array('name' => 'password2', 'title' => 'Repita sua Senha', 'placeholder' => 'Repitir Senha', 'value' => 'poipoipoi');
                                echo form_password($opts, '', $setup);
                                echo '</div>';


                                echo form_submit('enviar', 'Registrar', array('class' => 'btn btn-outline-info pull-right'));
                                // Form Closed
                                echo form_close();
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Wrap -->
                </div>
            </div>
        </div>
    </div>
</section>
</div>
