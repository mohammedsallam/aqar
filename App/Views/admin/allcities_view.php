<div class="box">
    <div class="box-header">
        <h3 class="box-title">جدول عرض المدن</h3>
    </div>

    <div class="alert alert-success delete_msg hidden col-lg-10 col-lg-offset-1">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="pull-right"></strong>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="user_table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>المدينة</th>
                <th>حذف</th>
                <th>تعديل</th>
            </tr>
            </thead>
            <tbody>

            <?php

            foreach ($allCities as $city) { ?>

                <tr class="tr_<?= $city->id ?>">
                    <td><?= $city->city ?></td>
                    <td><a data-city-id = "<?= $city->id ?>" class="btn btn-danger btn-sm delete_city_link" data-url="<?= $this->route->baseUrl() . 'Location/delete' ?>"><i class="fa fa-trash"></i></a></td>
                    <td><a data-city-id = "<?= $city->id ?>" class="btn btn-primary btn-sm edit_city_link" data-url="<?= $this->route->baseUrl() . 'Location/getCity' ?>" data-toggle="modal" data-target="#edit_city_modal"> <i class="fa fa-edit"></i> </a></td>

                </tr>

            <?php } ?>

            </tbody>
            <tfoot>
            <tr>
                <th>المدينة</th>
                <th>حذف</th>
                <th>تعديل</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.box-body -->
</div>


<!-- Modal -->
<div class="modal fade edit_city_modal" id="edit_city_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title pull-right clearfix">تعديل المدينة</h3>
                <button type="button" class="close pull-left" data-dismiss="modal" aria-label="Close">
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
