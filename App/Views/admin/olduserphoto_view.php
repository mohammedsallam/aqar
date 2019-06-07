<div class="box">
    <div class="box-header">
        <h3 class="box-title">جدول عرض الصورة القديمة</h3>
    </div>

    <div class="alert alert-success delete_msg hidden col-lg-10 col-lg-offset-1">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
        <strong class="pull-right"></strong>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="user_table" class="table table-bordered table-striped">

            <thead>
            <tr class="text-center">
                <td colspan="10">
                    <button class="btn btn-danger del_old_img_button" data-url="<?= $this->route->baseUrl() . 'Admin/deleteOldUserPhoto' ?>"> حذف الكل <i class="fa fa-trash"></i></button>
                </td>
            </tr>
            <tr>
                <th>الصورة</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody>

            <?php

            $targetDir = ABS_PATH.IMAGES_PATH .'users_profile'.DS;
            $sql = "SELECT user_img FROM users ";
            $photo = \Models\UsersModel::query($sql);

            $open = opendir($targetDir);
            $img = [];
            foreach ($photo as $item) {
                array_push($img, $item->user_img);
            }
            while (false !== ($entry = readdir($open))){
                if ($entry != '.' && $entry != '..'){

                    if (!in_array($entry, $img)){

                        $newEntry = explode('.', $entry);
                        ?>

                        <tr class="tr_<?= $newEntry[0] ?>">
                            <td>
                                <img style="max-width: 100px" src="<?= $this->route->baseUrl() . IMAGES_PATH . 'users_profile'.DS.$entry ?>" alt="">
                            </td>
                            <td><a data-entry = "<?= $newEntry[0] ?>" data-ext="<?=$newEntry[1]?>" class="btn btn-danger btn-sm delete_old_img_link" data-url="<?= $this->route->baseUrl() . 'Admin/deleteOldUserPhoto' ?>"><i class="fa fa-trash"></i></a></td>
                        </tr>

                    <?php }

                }
            }

            closedir($open);

           ?>

            </tbody>
            <tfoot>
            <tr>
                <th>الصورة</th>
                <th>حذف</th>
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
