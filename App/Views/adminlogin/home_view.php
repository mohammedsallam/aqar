<div class="container">
    <div class="row">

        <div class="card col-sm-6 offset-3 mt-5">
            <div class="card-body">

                <?php

                if ($this->session->has('success')){ ?>
                    <div class="alert alert-success text-center alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <?= $this->session->pull('success'); ?>
                    </div>
                <?php } ?>

                <?php

                if ($this->session->has('error')){ ?>
                    <div class="alert alert-warning text-center alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            <span class="sr-only">Close</span>
                        </button>
                        <?= $this->session->pull('error'); ?>
                    </div>
                <?php } ?>

                <!-- Alerts -->
                <div class="alert alert-success text-center success_msg d-none" role="alert"></div>
                <div class="alert alert-danger text-center error_msg d-none" role="alert"></div>
                <!-- End Alerts -->

                <h4 class="card-title text-center mb-5">تسجيل الدخول كأدمن</h4>
                <form class="login_form" method="post" action="<?= $this->route->baseUrl() . 'AdminLogin/check'?>">
                    <div class="form-group mb-3">
                        <input type="text" name="email" class="form-control" id="email"  placeholder="البريد الإلكتروني">
                        <small class="text-danger d-none">صيغة البريد الإلكتروني غير صالحة</small>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="كلمة المرور">
                        <small class="text-danger d-none">* هذا الحقل مطلوب</small>
                    </div>
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" value="1">
                        <label class="form-check-label" for="remember">
                            تذكرني
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-sm login_button">دخول</button>
                </form>
            </div>
        </div>

    </div>
</div>