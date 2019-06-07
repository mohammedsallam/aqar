<div class="container">
    <div class="row">

        <div class="card col-sm-6 offset-3 mt-5">
            <div class="card-body">
                <!-- Alerts -->
                <div class="alert alert-success success_msg d-none" role="alert"></div>
                <div class="alert alert-danger error_msg d-none" role="alert"></div>
                <!-- End Alerts -->

                <h4 class="card-title text-center mb-5">تسجيل مستخدم جديد</h4>
                <form method="post" class="admin_register_form" action="<?= $this->route->baseUrl() . 'AdminRegister/check'?>">
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" id="first_name"  placeholder="الإسم الأول">
                        <small class="text-danger d-none">الإسم الأول لا يقل عن 3 احرف</small>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" id="last_name"  placeholder="الإسم الأخير">
                        <small class="text-danger d-none">الإسم الأخير لا يقل عن 3 احرف</small>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" id="email"  placeholder="البريد الإلكتروني">
                        <small class="text-danger d-none">صيغة بريد إلكتروني غير صالحة</small>
                    </div>
<!--                    <div class="form-group">-->
<!--                        <input type="tel" name="phone" class="form-control" id="phone"  placeholder="رقم الجوال">-->
<!--                        <small class="text-danger d-none">رقم الجوال أرقام ولا يقل عن 10 أرقام ولا يزيد عن 14 رقم</small>-->
<!--                    </div>-->
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" id="password" placeholder="كلمة المرور">
                        <small class="text-danger d-none">كلمات المرور غير متطابقة</small>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_conf" class="form-control" id="password_conf" placeholder="تأكيد كلمة المرور">
<!--                        <small class="text-danger d-none">* هذا الحقل مطلوب</small>-->
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm admin_register_button">تسجيل</button>
                </form>
            </div>
        </div>

    </div>
</div>