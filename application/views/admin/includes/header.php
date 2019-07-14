<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="<?php echo base_url('home') ?>" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><strong>Gr1D</strong></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><strong>Gr1d</strong>Hack</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
    
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
            </nav>
        </header>

        

        <?php
        $menuActiveAux = [];
        if (isset($menuActive)){
            $menuActiveAux['menuActive'] = $menuActive;
        }
        $this->load->view("admin/includes/navbar-aside", $menuActiveAux); ?>
        <div class="content-wrapper">
        <div class="spinner-area">
            <div class="spinner"><i class="fa fa-spinner anim-rotate"></i></div>
        </div>