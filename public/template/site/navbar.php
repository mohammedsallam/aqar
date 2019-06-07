<?php
if ($this->cookie->has('id')){
    $user = \Models\UsersModel::getBy('id', $this->cookie->get('id'));
} else {
    $user = \Models\UsersModel::getBy('id', $this->session->get('id'));
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <a class="navbar-brand" href=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="<?= $this->route->baseUrl() ?>"><img class="logo_img" src="<?= $this->route->baseUrl() . IMAGES_PATH . 'logo.png'?>" alt="aqar.com"><span>استراحتي</span> <span class="sr-only">(current)</span></a>
            </li>
<!--            <li class="nav-item dropdown ">-->
<!--                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
<!--                    الأقسام-->
<!--                </a>-->
<!--                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">-->
<!--                    <a class="dropdown-item" href="#">Action</a>-->
<!--                    <a class="dropdown-item" href="#">Another action</a>-->
<!--                    <a class="dropdown-item" href="#">Something else here</a>-->
<!--                </div>-->
<!--            </li>-->

        </ul>

        <?php if (empty($user) == false) {

            if ($user->user_img == 'user.png') {
                $image = 'user.png';
                $border = 'border-0';
            } else {
                $image = 'users_profile'.DS.$user->user_img;
                $border = 'border';
            }

            ?>

            <ul class="navbar-nav offset-md-9">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="profile_img <?= $border ?>" src="<?= $this->route->baseUrl().IMAGES_PATH.$image?>" alt="">
                        <?= $user->first_name.' '.$user->last_name; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?= $this->route->baseUrl() .'advertise'?>">إعلاناتي</a>
                        <a class="dropdown-item user_modal_grape" data-user-id="<?= $user->id ?>" data-url="<?= $this->route->baseUrl() . 'Users/getUser'?>" href="Javascript:void()" data-toggle="modal" data-target="#user_modal">الحساب الشخصي</a>
                        <a class="dropdown-item" href="<?= $this->route->baseUrl() .'logout'?>"><i class="fa fa-sign-out"></i> خروج </a>
                    </div>
                </li>
            </ul>


        <?php } else { ?>

            <ul class="navbar-nav offset-md-9">
                <li class="nav-item dropdown ">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        تسجيل
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="<?= $this->route->baseUrl() . 'UserLogin'?>">دخول</a>
                        <a class="dropdown-item" href="<?= $this->route->baseUrl() . 'UserRegister'?>">مستخدم جديد</a>
                    </div>
                </li>
            </ul>
        <?php } ?>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-10 mx-auto mt-5">
            <form action="<?= $this->route->baseUrl() . 'Advertise/searchResult'?>" method="post" class="form-inline my-2 my-lg-0">
                <div class="form-group">
                    <input name="search" id="search" class="form-control mr-sm-2" type="search" placeholder="قم بالحبث الآن">
                </div>
<!--                <button class="btn btn-secondary btn-sm" type="button" data-toggle="collapse" data-target="#collapseSearch" aria-expanded="false" aria-controls="collapseExample">-->
<!--                    خيارات البحث-->
<!--                </button>-->
                <button class="btn btn-primary btn-sm ml-2 search_button">بحث</button>

<!--                <div class="collapse mt-4 col-lg-12" id="collapseSearch">-->
<!--                    <div class="card card-body">-->
<!--                        <div class="form-group">-->
<!--                            <div class="form-check mb-3">-->
<!--                                <input type="checkbox" class="form-check-input" name="remember" id="remember" value="1">-->
<!--                                <label class="form-check-label" for="remember">-->
<!--                                    تذكرني-->
<!--                                </label>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
            </form>
            <small class="text-danger search_msg d-none">حقل البحث مطلوب *</small>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade user_modal" id="user_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعديل الحساب الشخصي</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                <button type="button" class="btn btn-primary update_button">حفظ</button>
            </div>
        </div>
    </div>
</div>

