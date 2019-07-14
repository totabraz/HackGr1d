<?php
$login = "";
$email = "";
$name = "";
$permission_name = "";
$permission = 0;


if (isset($this->session->userdata)) {
    $user = isset($this->session->userdata)? $this->session->userdata : "";
    $cpf = isset($user['cpf'])? $user['cpf'] : "";
    $email = isset($user['email'])? $user['email'] : "";
    $cpf = isset($user['cpf'])? $user['cpf'] : "";
    $permission_name = isset($user['permission_name'])? $user['permission_name'] : "";
    $permission_value = isset($user['permission_value'])? $user['permission_value'] : "";
} else {
    header("location: " . base_url() . "admin/login");
}

$menuActiveSplited = '';
if (isset($menuActive)) {
    $menuActiveSplited = explode("/", $menuActive);
} else {
    $menuActive = ' ';
}

$display = 'block';

if (!isset($permission_value)) $permission_value = 2;

$nav_users = false;
$nav_vistorias  = false;
$nav_apolices  = false;

switch ($permission_value) {
    case PERMISSION_ROOT:
        $nav_users = true;
        break;

    case PERMISSION_CORRETOR:
        $$nav_vistorias = true;
        $nav_apolices = true;
        break;

    default:
        $nav_vistorias = true;
        break;
}



?>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">

                <img src="<?php echo base_url('dist/img/user_img_default.png'); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo  $name ?></p>
                <p><small><i class="fa fa-circle text-success"></i>&nbsp;<?php echo "Tipo usuário: " . $permission_name; ?></small></p>
            </div>
        </div>




        <ul class="sidebar-menu">
            <li class=" menu-open">
                <a href="#">
                    <i class="fa fa-globe"></i>&nbsp;<span>Público</span>
                </a>
                <?php $display = ($menuActiveSplited == 'casamento') ? 'block' : 'block'; ?>
                <ul class="treeview-menu " style="display:<?php echo $display ?>">
                    <li>
                        <a href="<?php echo base_url() ?>" target="_blunk"><i class="fa fa-external-link"></i>&nbsp;Ver site</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('logout') ?>" target="_blunk"><i class="fa fa-sign-out"></i>&nbsp;Sair</a>
                    </li>
                   
                </ul>
            </li>
        </ul>



        <ul class="sidebar-menu">
            <li class="header">MENU ADMIN</li>
        </ul>

        <!-- MENU USERS -->
        <?php if ($nav_users) { ?>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="treeview menu-open">
                    <a href="#">
                        <i class="fa fa-users"></i>&nbsp;<span>Usuários</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                    </a>
                    <?php $display = ($menuActiveSplited == 'users') ? 'block' : 'block'; ?>
                    <ul class="treeview-menu " style="display:<?php echo $display ?>">
                        <li><a href="<?php echo base_url('root/cadastrar'); ?>"><i class="fa fa-circle<?php if ($menuActive == 'root/create') echo " "; ?>-o"></i>&nbsp;Cadastrar</a></li>
                        <li><a href="<?php echo base_url('root/listar'); ?>"><i class="fa fa-circle<?php if ($menuActive == 'root/list') echo " "; ?>-o"></i>&nbsp;Listar</a></li>
                    </ul>
                </li>
            </ul>
        <?php } ?>







    </section>
    <!-- /.sidebar -->
</aside>