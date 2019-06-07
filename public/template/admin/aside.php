<?php

if ($this->session->has('admin_id')){
    $admin = \Models\AdminModel::getBy('id', $this->session->get('admin_id'));
} else {
    $admin = \Models\AdminModel::getBy('id', $this->cookie->get('admin_id'));
}

?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'admin'.DS.'user.png'?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?= $admin->first_name . ' ' . $admin->last_name?></p>
<!--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= $this->route->baseUrl() . 'Admin/home'?>">الرئيسية</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>المستخدمين</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= $this->route->baseUrl() . 'Admin/allUsers'?>"><i class="fa fa-user"></i> كل المستخدمين</a></li>
                    <li><a href="<?= $this->route->baseUrl() . 'Admin/addUser'?>"><i class="fa fa-user-plus"></i> إضافة مستخدم</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bullhorn"></i>
                    <span>الإعلانات</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= $this->route->baseUrl() . 'Admin/allAdv'?>"><i class="fa fa-bullhorn"></i> كل الإعلانات</a></li>
                    <li><a href="<?= $this->route->baseUrl() . 'Admin/addAdv'?>"><i class="fa fa-plus"></i> إضافة إعلان</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-home"></i>
                    <span>المدن</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= $this->route->baseUrl() . 'Admin/allCities'?>"><i class="fa fa-home"></i> كل المدن</a></li>
                    <li><a href="<?= $this->route->baseUrl() . 'Admin/addCity'?>"><i class="fa fa-plus"></i> إضافة مدينة</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-photo"></i>
                    <span>صور قديمة</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?= $this->route->baseUrl() . 'Admin/oldUserPhoto'?>"><i class="fa fa-home"></i> كل الصور القديمة</a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>