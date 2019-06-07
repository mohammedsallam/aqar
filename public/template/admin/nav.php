<?php

if ($this->session->has('admin_id')){
    $admin = \Models\AdminModel::getBy('id', $this->session->get('admin_id'));
} else {
    $admin = \Models\AdminModel::getBy('id', $this->cookie->get('admin_id'));
}

?>

<header class="main-header">
    <!-- Logo -->
    <a href="<?= $this->route->baseUrl() . 'Admin/home'?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b> Dashboard</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'admin'.DS.'user.png'?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?= $admin->first_name . ' ' . $admin->last_name?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?= $this->route->baseUrl() . IMAGES_PATH . 'admin'.DS.'user.png'?>" class="img-circle" alt="User Image">

                            <p>
                                <b><?= $admin->first_name . ' ' . $admin->last_name?></b>
                                <small>مدير موقع</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
<!--                            <div class="row">-->
<!--                                <div class="col-xs-4 text-center">-->
<!--                                    <a href="#">Followers</a>-->
<!--                                </div>-->
<!--                                <div class="col-xs-4 text-center">-->
<!--                                    <a href="#">Sales</a>-->
<!--                                </div>-->
<!--                                <div class="col-xs-4 text-center">-->
<!--                                    <a href="#">Friends</a>-->
<!--                                </div>-->
<!--                            </div>-->
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#admin_edit_profile" class="btn btn-default btn-flat" data-toggle="modal">حسابي</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?= $this->route->baseUrl(). 'Logout' ?>" class="btn btn-default btn-flat"> خروج <i class="fa fa-sign-out"></i></a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Modal -->
<div class="modal fade admin_edit_profile" id="admin_edit_profile" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <b class="modal-title">تعديل الحساب الشخصي</b>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Alerts -->
                <div class="alert alert-success text-center success_msg hidden" role="alert"></div>
                <div class="alert alert-danger text-center error_msg hidden" role="alert"></div>
                <!-- End Alerts -->

                <form method="post" class="update_form" action="<?= $this->route->baseUrl() . 'Admin/editProfile'?>">
                    <input type="hidden" name="id" value="<?= $admin->id ?>">
                    <div class="form-group clearfix">
                        <input type="text" name="first_name" class="form-control text-right" id="first_name"  placeholder="الإسم الأول" value="<?= $admin->first_name ?>">
                        <small class="text-danger hidden pull-right">الإسم الأول لا يقل عن 3 احرف</small>
                    </div>
                    <div class="form-group clearfix">
                        <input type="text" name="last_name" class="form-control text-right" id="last_name"  placeholder="الإسم الأخير" value="<?= $admin->last_name ?>">
                        <small class="text-danger pull-right hidden">الإسم الأخير لا يقل عن 3 احرف</small>
                    </div>
                    <div class="form-group clearfix">
                        <input type="email" name="email" class="form-control text-right" id="email"  placeholder="البريد الإلكتروني" value="<?= $admin->email ?>">
                        <small class="text-danger pull-right hidden">صيغة بريد إلكتروني غير صالحة</small>
                    </div>
                    <div class="form-group clearfix">
                        <input type="password" name="password" class="form-control text-right" id="password" placeholder="كلمة المرور">
                        <small class="text-danger pull-right hidden">كلمات المرور غير متطابقة</small>
                    </div>
                    <div class="form-group clearfix">
                        <input type="password" name="password_conf" class="form-control text-right" id="password_conf" placeholder="تأكيد كلمة المرور">
                        <!--                        <small class="text-danger pull-right hidden">* هذا الحقل مطلوب</small>-->
                    </div>
<!--                    <div class="form-group pull-right">-->
<!--                        <label for="img" class="btn btn-success "><i class="fa fa-image"></i> إضافة صور</label>-->
<!--                        <input type="file" name="files" class="form-control hidden text-right img" id="img">-->
<!--                    </div>-->
<!---->
<!--                    <div class="hidden img_container"></div>-->
<!--                    <b class="btn btn-danger delete_img">حذف الصور</b>-->
<!--                    <div class="imgContent hidden"></div>-->

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-primary update_button">حفظ</button>
            </div>
        </div>
    </div>
</div>
