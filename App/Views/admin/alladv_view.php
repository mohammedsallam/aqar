<?php

$allAdves = \Models\AdvertiseModel::getAll();

?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">جدول عرض الإعلانات</h3>
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
                <th>عنوان الإعلان</th>
                <th>الوصف</th>
                <th>الموقع</th>
                <th>حذف</th>
                <th>المزيد</th>
            </tr>
            </thead>
            <tbody>

            <?php

            foreach ($allAdves as $adve) { ?>

                <tr class="tr_<?= $adve->id ?>">
                    <td><?= $adve->title ?></td>
                    <td style="word-break: break-all"><?= $adve->description?></td>
                    <td><?= $adve->location ?></td>

                    <td><a data-adv-id = "<?= $adve->id ?>" class="btn btn-danger btn-sm delete_adv_link" href="<?= $this->route->baseUrl() . 'Advertise/delete'?>"><i class="fa fa-trash"></i></a></td>
                    <td><a data-adv-id = "<?= $adve->id ?>" class="btn btn-success btn-sm edit_user_link" href="<?= $this->route->baseUrl() . 'Admin/moreAdv/'.$adve->id?>"> قراءة المزيد </a></td>

                </tr>

            <?php } ?>

            </tbody>
            <tfoot>
            <tr>
                <th>عنوان الإعلان</th>
                <th>الوصف</th>
                <th>الموقع</th>
                <th>حذف</th>
                <th>المزيد</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.box-body -->
</div>


<!-- Modal -->
<div class="modal fade edit_adv_modal" id="edit_adv_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title pull-right clearfix">تعديل المستخدم</h3>
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
