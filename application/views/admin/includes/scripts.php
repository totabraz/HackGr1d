<!-- jvectormap -->
<link rel="stylesheet" href="<?php echo base_url('bower_components/jvectormap/jquery-jvectormap.css'); ?>">
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- FastClick -->
<script src="<?php echo base_url('bower_components/fastclick/lib/fastclick.js'); ?>"></script>

<!-- DataTables -->
<script src="<?php echo base_url('bower_components/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php echo base_url('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('dist/vendors-external/AdminLTE/js/adminlte.min.js'); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('bower_components/jquery-sparkline/dist/jquery.sparkline.min.js'); ?>"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('dist/vendors-external/AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
<script src="<?php echo base_url('dist/vendors-external/AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('bower_components/chart.js/Chart.js'); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('dist/vendors-external/AdminLTE/js/pages/dashboard2.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('dist/vendors-external/AdminLTE/js/demo.js'); ?>"></script>
<script>
    function hideSpinner() {
        $('.spinner-area').css({
            'height': '0',
            'width': '0',
            'top': '50%',
            'left': '50%',
            'opacity': '0',
            // 'transform':'scale(0)'

        });
    }

    function showSpinner() {
        $('.spinner-area').css({
            'height': '100vh',
            'width': '100%',
            'top': '0',
            'left': '0',
            'opacity': '1',
            // 'transform':'scale(0)'

        });
    }</script>

<script>
    $(function() {
        $('#example1').DataTable()
        $('#example2').DataTable({
            'paging': true,
            'lengthChange': false,
            'searching': false,
            'ordering': true,
            'info': true,
            'autoWidth': false
        })
    });


    $(document).ready(function() {
        $('#example1_filter').addClass('text-right');
        hideSpinner();

        console.log('carregou');
        $('#cpf_form').focusout(function() {
            showSpinner();
            console.log($('#cpf').val);
            const $rawBody = {
                "Datasets": "basic_data",
                "q": "doc{" + this.value + "}",
                "AccessToken": ""
            };
            $.ajax({
                url: "https://gateway.gr1d.io/sandbox/bigdata/bigboost/v1/peoplev2",
                type: 'POST',
                dataType: 'json',
                headers: {
                    'x-api-key': '52d2e55d-0561-4178-b812-079491fa1769',
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify($rawBody),
                contentType: 'application/json; charset=utf-8',
                success: function(result) {

                    hideSpinner();
                    $("#name_form").val(result.Result[0]['BasicData']['Name']);


                },
                error: function(error) {
                    console.log("pifou")
                    hideSpinner();
                }
            });

        });

        $('#id_placa').focusout(function() {
            showSpinner();
            console.log($('#cpf').val);
            const $rawBody = {
                "Datasets": "basic_data",
                "q": "doc{" + this.value + "}",
                "AccessToken": ""
            };
            $.ajax({
                url: "https://gateway.gr1d.io/sandbox/unionsolution/renavam/v1/renavam",
                type: 'GET',
                headers: {
                    'x-api-key': '69bf6911-d909-41eb-bde3-aaf50df1ada1',
                    'Content-Type': 'application/json'
                },
                data: {
                    'pstrPlaca': 'NOB8614',
                    'pstrFormat': 'json',
                },
                contentType: 'application/json; charset=utf-8',
                success: function(result) {

                    hideSpinner();
                    $("#id_chassi").val(result.struct_RespostaRst.Resposta.Chassi);
                    $("#id_renavam").val(result.struct_RespostaRst.Resposta.Renavam);
                    console.log(result);


                },
                error: function(error) {
                    console.log("pifou")
                    hideSpinner();
                }
            });

        });
    });
</script>
</body>

</html>