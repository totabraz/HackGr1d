<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Content Header (Page header) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
$date_casamento = isset($casamentos['date_casamento']) ? changeDateFromDB($casamentos['date_casamento']) : date('d-m-Y');

?>
<script>
    $(document).ready(function() {
        console.log( "date: ");
        $(function() {
            $("#datepicker").datepicker();
            $('#datepicker').datepicker("option", "dateFormat", 'dd-mm-yy');
            $("#datepicker").datepicker('setDate', '<?php echo $date_casamento?>');
            
        });
    });
</script>

<style>
    .ui-widget-content.ui-helper-clearfix.ui-corner-all {
        z-index: 8010 !important;
    }
</style>

<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12 col-dm-10 col-md-8 col-lg-6 ">
            <!-- /.box -->
            <div class="box">
                <section class="content-header">
                    <h1 class=" col-xs-12 text-center">
                        <strong class="text-uppercase">Album</strong> - <em>
                            <?php
                            if (isset($title)) echo $title;
                            else echo "Nova/Editar Notícia";
                            ?>
                        </em>
                    </h1>
                </section>
                <hr class="" />
                <!-- /.box -->
                <div class="box-body">
                    <?php if ($msg = get_msg()) echo $msg; ?>
                    <div class="">
                        <div class="card">
                            <div class="card-body">
                                <?php
                                $setup = array(
                                    'class' => 'form-control',
                                    'trim|required'
                                );
                                if ($msg = get_msg()) {
                                    echo $msg;
                                }
                                echo form_open_multipart();

                                
                                $name_marido = isset($casamentos['name_marido']) ? $casamentos['name_marido'] : "";
                                $name_esposa = isset($casamentos['name_esposa']) ? $casamentos['name_esposa'] : "";
                                $img1 = isset($casamentos['img1']) ? $casamentos['img1'] : "";
                                $img2 = isset($casamentos['img2']) ? $casamentos['img2'] : "";
                                $img3 = isset($casamentos['img3']) ? $casamentos['img3'] : "";
                                $img4 = isset($casamentos['img4']) ? $casamentos['img4'] : "";

                                // FORM ADD NEW

                                echo ' <div class="form-group">';
                                $opts = array('name' => 'name_marido', 'value' => $name_marido, 'title' => 'Nome do Marido');
                                echo form_label('Nome do Marido:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';

                                echo ' <div class="form-group">';
                                $opts = array('name' => 'name_esposa', 'value' => $name_esposa, 'title' => 'Nome da Esposa');
                                echo form_label('Nome da Esposa:');
                                echo form_input($opts, '', $setup);
                                echo '</div>';


                                echo ' <div class="form-group">';
                                $opts = array('name' => 'date_casamento', 'id' => 'datepicker', 'value' => $date_casamento, 'title' => 'Data do casamento');
                                echo form_label('Data do casamento:');
                                echo form_input($opts, '', $setup);
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
                                                    <label class="col-xs-12 custom-file-label" for="imgFormInput1">Anexar 1a Imagem</label>
                                                    <input id="imgFormInput1" class="col-xs-12" type="file" name="img1" size="20">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (isset($img1) && $img1 != '') { ?>
                                            <figure class="col-xs-12">
                                                <img src="<?php echo base_url('uploads/') . $img1 ;?>" style="width:100px; height:100px;" />
                                            </figure>
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
                                                    <label class="col-xs-12 custom-file-label" for="imgFormInput2">Anexar 3a Imagem</label>
                                                    <input id="imgFormInput2" class="col-xs-12" type="file" name="img2" size="20">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (isset($img2) && $img2 != '') { ?>
                                            <figure class="col-xs-12">
                                                <img src="<?php echo base_url('uploads/') . $img2 ;?>" style="width:100px; height:100px;" />
                                            </figure>
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
                                                    <label class="col-xs-12 custom-file-label" for="imgFormInput3">Anexar 3a Imagem</label>
                                                    <input id="imgFormInput3" class="col-xs-12" type="file" name="img3" size="20">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (isset($img3) && $img3 != '') { ?>
                                            <figure class="col-xs-12">
                                                <img src="<?php echo base_url('uploads/') . $img3 ;?>" style="width:100px; height:100px;" />
                                            </figure>
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
                                                    <label class="col-xs-12 custom-file-label" for="imgFormInput4">Anexar 4a Imagem</label>
                                                    <input id="imgFormInput4" class="col-xs-12" type="file" name="img4" size="20">
                                                </div>
                                            </div>
                                        </div>
                                        <?php if (isset($img4) && $img4 != '') { ?>
                                            <figure class="col-xs-12">
                                                <img src="<?php echo base_url('uploads/') . $img4 ;?>" style="width:100px; height:100px;" />
                                            </figure>
                                        <?php } ?>
                                    </div>
                                </div>
                                <?php

                                // ====== Submit
                                echo form_submit(
                                    'enviar',
                                    'Salvar',
                                    array('class' => 'btn btn-success pull-right')
                                );
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


<script>
    var $hora = ['22', '00', '00'];
    var $url = 'txDHMarcacao=' + $hora[0] + '%3A' + $hora[1] + '%3A' + $hora[2] + '&txHour=' + $hora[0] + '&txMinute=' + $hora[1] + '&txSeconds=' + $hora[2] + '&txLatitude=0.0&txLongitude=0.0&cboLocal=3022;';
</script>