<?php
namespace Controllers;

use Models\UsersModel;
use System\ImageCompress;

class UsersController extends Controller
{

    public function editProfile()
    {



//        if (! $this->session->get('user_email')){
//            header('location:' . $this->route->baseUrl());
//            exit();
//        }

        $userData['id'] = $this->filter->int($this->request->post('id'));
        $userData['first_name'] = $this->filter->stringStrip($this->request->post('first_name'));
        $userData['last_name'] = $this->filter->stringStrip($this->request->post('last_name'));
        $userData['email'] = $this->filter->email($this->request->post('email'));
        $userData['phone'] = $this->filter->string($this->request->post('phone'));
        $userData['password'] = $this->filter->password($this->request->post('password'));
        $userData['password_conf'] = $this->filter->password($this->request->post('password_conf'));

        $id = $userData['id'];


        if ($this->request->requestMethod() == 'POST'){

            $sql = "SELECT * FROM users WHERE id != $id";

            $user = UsersModel::query($sql);


           if (empty($user) == false){
               foreach ($user as $email) {
                   if ($email->email == $this->request->post('email')){
                       $data['status'] = 'error';
                       $data['msg'] = 'البريد الإلكتروني موجود بالفعل';
                       echo json_encode($data);
                       exit();
                   }

                   if ($email->phone == $this->request->post('phone')){
                       $data['status'] = 'error';
                       $data['msg'] = 'رقم الجوال موجود بالفعل';
                       echo json_encode($data);
                       exit();
                   }
               }
           }


            if (empty($userData['first_name']) == true){
                $data['status'] = 'error';
                $data['msg'] = 'فضلاً قم بكتابة الإسم الأول';
                echo json_encode($data);
                exit();
            }

            if (empty($userData['last_name']) == true){
                $data['status'] = 'error';
                $data['msg'] = 'فضلاً قم بكتابة الإسم الأخير';
                echo json_encode($data);
                exit();
            }

            if (mb_strlen($userData['first_name']) < 3){
                $data['status'] = 'error';
                $data['msg'] = 'الإسم الأول لا يقل عن 2 أحرف';
                echo json_encode($data);
                exit();
            }

            if (mb_strlen($userData['last_name']) < 3){
                $data['status'] = 'error';
                $data['msg'] = 'الإسم الأخير لا يقل عن 2 أحرف';
                echo json_encode($data);
                exit();
            }


            if ($userData['email'] == false){
                $data['status'] = 'error';
                $data['msg'] = 'صيغة البريد الإلكتروني غير صحيحة';
                echo json_encode($data);
                exit();
            }

            if ($userData['email'] == false){
                $data['status'] = 'error';
                $data['msg'] = 'صيغة البريد الإلكتروني غير صحيحة';
                echo json_encode($data);
                exit();
            }


            if (empty($userData['password']) == false){

                if ($userData['password'] == ''){
                    $data['status'] = 'error';
                    $data['msg'] = 'فضلاً قك بكتابة كلمة المرور';
                    echo json_encode($data);
                    exit();
                }

                if ($userData['password'] != $userData['password_conf']){
                    $data['status'] = 'error';
                    $data['msg'] = 'كلمات المرور غير متطابقة';
                    echo json_encode($data);
                    exit();
                }

                if (mb_strlen($userData['password']) < 8 || mb_strlen($userData['password_conf']) < 8){
                    $data['status'] = 'error';
                    $data['msg'] = 'كلمات المرور لا تقل عن 8 أحرف';
                    echo json_encode($data);
                    exit();
                }


                $userData['password'] = password_hash($userData['password'].'!@#$%^&*()', CRYPT_BLOWFISH);

            }

            if (empty($userData['password_conf']) == false){
                if ($userData['password'] == ''){
                    $data['status'] = 'error';
                    $data['msg'] = 'فضلاً قم بكتابة كلمة المرور';
                    echo json_encode($data);
                    exit();
                }

            }

            unset($userData['password_conf'], $userData['id']);

            if ($userData['password'] == ''){
                unset($userData['password']);
            }

            $allowTypes = array('jpg','png','jpeg');

            if(empty($_FILES['user_img']['tmp_name']) == false){

                $fileName = basename($_FILES['user_img']['name']);

                $ext = explode('.', $fileName);
                $ext = end($ext);
                $ext = strtolower($ext);

                $fileName = md5(rand(0000, 9999)).'_'.md5(rand(0000, 9999)).'_.'.$ext;
                $targetDir = ABS_PATH.IMAGES_PATH .'users_profile'.DS;

                if(exif_imagetype($_FILES['user_img']['tmp_name']) == false){
                    $data['status'] = 'error';
                    $data['msg'] = ' ملف صورة غير صالح '.$_FILES['user_img']['name'];
                    echo json_encode($data);
                    exit();
                }

                if (!in_array($ext, $allowTypes)){
                    $data['status'] = 'error';
                    $data['msg'] = ' امتداد غير مسموح به '. $_FILES['user_img']['name'];
                    echo json_encode($data);
                    exit();
                }


                $targetFilePath = $targetDir.$fileName;

                ImageCompress::compressImage($_FILES["user_img"]["tmp_name"], $targetFilePath, 90);

                $userData['user_img'] = $fileName;
            }


            foreach ($userData as $key => $value) {

                $column[] = $key;
                $columnValue[] = $value;

                $this->session->set($key, $value);
            }

            UsersModel::update( $column, $columnValue, "id = $id");

//            if ($this->request->post('user_img')){
//                $allow_ext  = array('jpg','jpeg','png','gif');
//                $ext = explode('.', $_FILES['user_image']['name']);
//                $ext = end($ext);
//                $ext = strtolower($ext);
//                if(in_array($ext,$allow_ext)) {
//                    $new_name = $this->request->post('user_img');
//                    move_uploaded_file($_FILES['user_image']['tmp_name'], ABS_PATH . IMAGES_PATH . $new_name);
//                } else {
//                    $data['status'] = 'error';
//                    $data['msg'] = 'ملف غير مسموح به';
//                    echo json_encode($data);
//                    exit();
//                }
//            }

            $data['status'] = 'success';
            $data['msg'] = 'تم التعديل بنجاح';
            echo json_encode($data);
            exit();

        }

    }

    public function activation()
    {
        $code = $this->app->params;

        $user = UsersModel::getBy('code', $code);

        if(empty($user) == false){
            $this->session->set('success', 'تم تفعيل البريد بنجاح يمكنك الآن تسجيل الدخول');
            $sql = "UPDATE users SET verified = 1, code = null WHERE id = $user->id";
            UsersModel::query($sql);
            header('location:' . $this->route->baseUrl() . 'UserLogin');
            exit();
        } else {
            $this->session->set('error', 'رابط تفعيل غير صالح');
            header('location:' . $this->route->baseUrl() . 'UserLogin');
            exit();

        }
    }

    public function delete()
    {
        $id = $this->request->post('id');

        $user = UsersModel::getBy('id', $id);

        if(empty($user) == false){
            UsersModel::delete("id = $id");

            $data['status'] = 'success';
            $data['msg'] = " تم حذف المستخدم رقم $id بنجاح ";
            echo json_encode($data);
        } else {
            $data['status'] = 'error';
            $data['msg'] = 'هذا المستخدم غير موجود';
            echo json_encode($data);
        }
    }
    
    
    public function getUser()
    {
        $id = $this->request->post('id');
        $user = UsersModel::getBy('id', $id);
        if ($this->request->requestMethod() == 'POST') { ?>
            <!-- Alerts -->
            <div class="alert alert-success text-center success_msg hidden d-none" role="alert"></div>
            <div class="alert alert-danger text-center error_msg hidden d-none" role="alert"></div>
            <!-- End Alerts -->

            <form method="post" class="update_form" style="direction: rtl" action="<?= $this->route->baseUrl() . 'Users/editProfile'?>">
                <input type="hidden" name="id" value="<?= $user->id ?>">
                <div class="form-group">
                    <input type="text" name="first_name" class="form-control" id="first_name"  placeholder="الإسم الأول" value="<?= $user->first_name ?>">
                    <small class="text-danger hidden d-none">الإسم الأول لا يقل عن 3 احرف</small>
                </div>
                <div class="form-group">
                    <input type="text" name="last_name" class="form-control" id="last_name"  placeholder="الإسم الأخير" value="<?= $user->last_name ?>">
                    <small class="text-danger hidden d-none">الإسم الأخير لا يقل عن 3 احرف</small>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" id="email"  placeholder="البريد الإلكتروني" value="<?= $user->email ?>">
                    <small class="text-danger hidden d-none">صيغة بريد إلكتروني غير صالحة</small>
                </div>
                <div class="form-group">
                    <input type="tel" name="phone" class="form-control" id="phone"  placeholder="رقم الجوال" value="<?= $user->phone ?>">
                    <small class="text-danger hidden d-none">رقم الجوال أرقام ولا يقل عن 10 أرقام ولا يزيد عن 14 رقم</small>
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" id="password" placeholder="كلمة المرور">
                    <small class="text-danger hidden d-none">كلمات المرور غير متطابقة</small>
                </div>
                <div class="form-group">
                    <input type="password" name="password_conf" class="form-control" id="password_conf" placeholder="تأكيد كلمة المرور">
                </div>
                <div class="form-group">
                    <label for="user_img" class="btn btn-success btn-sm"> إضافة صورة <i class="fa fa-photo"></i></label>
                    <input type="file" name="user_img" class="form-control hidden d-none user_img" id="user_img">
                </div>
            </form>
            <div class="userImgContentForm d-none position-absolute"></div>
            <button class="del_img_profile d-none position-absolute btn btn-danger btn-sm"><i class="fa fa-trash"></i> حذف الصورة </button>

        <?php } else {
            header('location:' . $this->route->baseUrl());
            exit();
        }

    }
    
}