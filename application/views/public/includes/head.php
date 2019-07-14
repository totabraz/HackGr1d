<?php
if (isset($this->session->userdata)) {
    if (isset($this->session->userdata['login'])) $login = $this->session->userdata['login'];
    if (isset($this->session->userdata['email'])) $email = $this->session->userdata['email'];
    if (isset($this->session->userdata['name'])) $name = $this->session->userdata['name'];
} else {
    header("location: " . base_url() . "login");
}
?>
<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('dist/img/favicon.ico'); ?>">

    <link rel="stylesheet" href="<?php echo base_url('dist/vendors-external/bootstrap/css/bootstrap.min.css'); ?>">

    <link href="<?php echo base_url('dist/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url('dist/css/style-public.css'); ?>" rel="stylesheet">
    
    <script src="<?php echo base_url('dist/vendors/jquery/js/jquery.js') ?>"></script>
    
    
    <link href="https://fonts.googleapis.com/css?family=Poiret+One&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<?php
if (isset($header) && ($header == 'home')) $this->load->view('public/includes/header-home');
else $this->load->view('public/includes/header-internas');
?>

<body id="page-top">

    <div class="body-page">
        <!-- STARTING PAGE -->