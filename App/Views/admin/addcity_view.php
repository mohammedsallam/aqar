<div class="panel panel-default col-lg-12">
    <div class="panel-title text-center">
        <b>إضافة مدينة</b>
    </div>
    <div class="panel-body">
        <!-- Alerts -->
        <div class="alert alert-success success_msg hidden text-center" role="alert"></div>
        <div class="alert alert-danger error_msg hidden text-center" role="alert"></div>
        <!-- End Alerts -->

        <form method="post" class="add_city_form" id="add_city_form" action="<?= $this->route->baseUrl() . 'Location/editAndAdd'?>">
            <div class="form-group clearfix">
                <label for="city" class="pull-right">اسم المدينة</label>
                <input type="text" name="city" class="form-control text-right" id="city"  placeholder="اسم المدينة">
                <small class="text-danger hidden pull-right">هذا الحقل مطلوب *</small>
            </div>
            <button type="submit" class="btn btn-primary btn-sm add_city_button pull-right">إضافة مدينة</button>
        </form>

    </div>
</div>