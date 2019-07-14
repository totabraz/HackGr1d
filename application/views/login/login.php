<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html"><b><?php echo SITE_SIGLA ?></b>Sys</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">Login</p>
            <?php
            if ($msg = get_msg()) {
                echo $msg;
            }
            ?>
            <div class="">
                <div class="card card-login mx-auto mt-5">
                    <div class="card-body">

                        <?php

                        $setup = array('class' => 'form-control', 'trim|required');

                        if ($msg = get_msg()) {
                            echo $msg;
                        }

                        echo form_open();
                        echo '<div class="form-group">';
                        $opts = array('name' => 'cpf', 'title' => 'Infome seu CPF', 'placeholder' => 'CPF', 'autofocus' => 'autofocus', 'value' => '08484668452');
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
                            LABEL_CLIENTE => LABEL_CLIENTE,
                            LABEL_ROOT => LABEL_ROOT,
                        );
                        $opts = array('autocomplete' => 'off', 'name' => 'permission_name', 'value' => LABEL_CLIENTE, 'title' => 'Tipo de Usuário', 'class' => 'form-control editorhtml col');
                        echo form_dropdown($opts, $permission_name, LABEL_CLIENTE);
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';

                        echo '<div class="form-group">';
                        $opts = array('name' => 'password', 'title' => 'Infome sua Senha', 'placeholder' => 'Senha', 'value' => '08484668452');
                        echo form_password($opts, '', $setup);
                        echo '</div>';

                        echo form_submit('enviar', 'Entrar', array('class' => 'btn btn-info'));
                        // Form Closed
                        echo form_close();
                        ?>
                    </div>
                </div>
            </div>

            <?php /*
            <div class="social-auth-links text-center">
                <p>- OU -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
                    Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
                    Google+</a>
            </div>
            <!-- /.social-auth-links -->
            
            <a href="#">I forgot my password</a><br>
            <a href="register.html" class="text-center">Register a new membership</a>
             */ ?>

        </div>
        <!-- /.login-box-body -->
    </div>