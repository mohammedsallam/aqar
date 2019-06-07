<?php

$allUsers = \Models\UsersModel::getAll();

?>

<div class="box">
    <div class="box-header">
        <h3 class="box-title">جدول عرض المستخدمين</h3>
    </div>
    <div class="alert alert-success delete_msg hidden col-lg-10 col-lg-offset-1">
        <strong class="pull-right"></strong>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="user_table" class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>الإسم الأول</th>
                <th>الإسم الأخير</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الجوال</th>
                <th>حذف</th>
                <th>تعديل</th>
            </tr>
            </thead>
            <tbody>

                <?php

                foreach ($allUsers as $allUser) { ?>

                    <tr class="tr_<?= $allUser->id ?>">
                        <td><?= $allUser->first_name ?></td>
                        <td><?= $allUser->last_name ?></td>
                        <td><?= $allUser->email ?></td>
                        <td><?= $allUser->phone ?></td>
                        <td><a data-user-id = "<?= $allUser->id ?>" class="btn btn-danger btn-sm delete_user_link" href="<?= $this->route->baseUrl() . 'Users/delete'?>"><i class="fa fa-trash"></i></a></td>
                        <td><a data-user-id = "<?= $allUser->id ?>" data-url="<?= $this->route->baseUrl() . 'Users/getUser'?>" data-toggle="modal" data-target="#edit_user_modal" class="btn btn-primary btn-sm edit_user_link" href=""><i class="fa fa-edit"></i></a></td>
                    </tr>

                <?php } ?>

            </tbody>
            <tfoot>
            <tr>
                <th>الإسم الأول</th>
                <th>الإسم الأخير</th>
                <th>البريد الإلكتروني</th>
                <th>رقم الجوال</th>
                <th>حذف</th>
                <th>تعديل</th>
            </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.box-body -->
</div>



<!-- Modal -->
<div class="modal fade edit_user_modal" id="edit_user_modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
