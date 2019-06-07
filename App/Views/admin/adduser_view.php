<!-- Alerts -->
<div class="alert alert-success success_msg hidden text-center" role="alert"></div>
<div class="alert alert-danger error_msg hidden text-center" role="alert"></div>
<!-- End Alerts -->

<h4 class="card-title text-center mb-5">تسجيل مستخدم جديد</h4>
<form method="post" class="user_register_form" action="<?= $this->route->baseUrl() . 'UserRegister/check'?>">
    <div class="form-group clearfix">
        <input type="text" name="first_name" class="form-control text-right" id="first_name"  placeholder="الإسم الأول">
        <small class="text-danger hidden pull-right">الإسم الأول لا يقل عن 3 احرف</small>
    </div>
    <div class="form-group clearfix">
        <input type="text" name="last_name" class="form-control text-right" id="last_name"  placeholder="الإسم الأخير">
        <small class="text-danger hidden pull-right">الإسم الأخير لا يقل عن 3 احرف</small>
    </div>
    <div class="form-group clearfix">
        <input type="email" name="email" class="form-control text-right" id="email"  placeholder="البريد الإلكتروني">
        <small class="text-danger hidden pull-right">صيغة بريد إلكتروني غير صالحة</small>
    </div>
    <div class="form-group clearfix">
        <input type="tel" name="phone" class="form-control text-right" id="phone"  placeholder="رقم الجوال">
        <small class="text-danger hidden pull-right">رقم الجوال أرقام ولا يقل عن 10 أرقام ولا يزيد عن 14 رقم</small>
    </div>
    <div class="form-group clearfix">
        <input type="password" name="password" class="form-control text-right" id="password" placeholder="كلمة المرور">
        <small class="text-danger hidden pull-right">كلمات المرور غير متطابقة</small>
    </div>
    <div class="form-group clearfix">
        <input type="password" name="password_conf" class="form-control text-right" id="password_conf" placeholder="تأكيد كلمة المرور">
        <!--                        <small class="text-danger hidden">* هذا الحقل مطلوب</small>-->
    </div>
    <button type="submit" class="btn btn-primary btn-sm user_register_button pull-right">تسجيل</button>
</form>
