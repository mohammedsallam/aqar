<?php
namespace Controllers;

use Models\UsersModel;
use System\EmailFormat;
use System\ImageCompress;
use System\PHPMailer\Exception;

class UserRegisterController extends Controller
{

    public $loadCss = [
        'bootstrap',
        'fa',
        'style',

    ];

    public $loadJs = [
        'jquery',
        'bootstrap',
        'main'
    ];


    public function home()
    {

        if ($this->session->has('id') || $this->cookie->has('id')){
            header('location:' . $this->route->baseUrl());
            exit();
        }

        $this->app->container['title'] = 'تسجيل مستخدم جديد';
        $this->siteView();
    }

    public function check()
    {

        $userData['first_name'] = $this->filter->stringStrip($this->request->post('first_name'));
        $userData['last_name'] = $this->filter->stringStrip($this->request->post('last_name'));
        $userData['email'] = $this->filter->email($this->request->post('email'));
        $userData['phone'] = $this->filter->string($this->request->post('phone'));
        $userData['password'] = $this->filter->password($this->request->post('password'));
        $userData['password_conf'] = $this->filter->password($this->request->post('password_conf'));


        $email = $userData['email'];
        $phone = $userData['phone'];

        $sql = "SELECT * FROM users WHERE email = '$email' OR phone = '$phone'" ;

        $user = UsersModel::query($sql);

        if ($this->request->requestMethod() == 'POST') {

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


            if (!$userData['email']){
                $data['status'] = 'error';
                $data['msg'] = 'صيغة البريد الإلكتروني غير صالحة';
                echo json_encode($data);
                exit();
            }

            if (!$userData['phone']){
                $data['status'] = 'error';
                $data['msg'] = 'رقم الجوال لا يقل عن 10 أرقام ولا يزيد عن 14 رقم';
                echo json_encode($data);
                exit();
            }

            if (mb_strlen($userData['password']) < 8 || mb_strlen($userData['password_conf']) < 8){
                $data['status'] = 'error';
                $data['msg'] = 'كلمة المرور وتأكيد كلمة المرور لا تقل عن 8 أحرف';
                echo json_encode($data);
                exit();
            }

            if (empty($userData['password'])){
                $data['status'] = 'error';
                $data['msg'] = 'كلمات المرور غير متطابقة';
                echo json_encode($data);
                exit();
            }

            if (empty($userData['password_conf'])){
                $data['status'] = 'error';
                $data['msg'] = 'كلمات المرور غير متطابقة';
                echo json_encode($data);
                exit();
            }

            if ($userData['password'] != $userData['password_conf']){
                $data['status'] = 'error';
                $data['msg'] = 'كلمات المرور غير متطابقة';
                echo json_encode($data);
                exit();
            }

            if (empty($user) == false) {
                $data['status'] = 'error';
                $data['msg'] = 'تم التسجيل مسبقا بهذه البيانات';
                echo json_encode($data);
                exit();
            }

            $userData['password'] = password_hash($userData['password'].'!@#$%^&*()', CRYPT_BLOWFISH);

            unset($userData['password_conf']);

            $userData['code'] = md5(random_bytes(50)).md5(random_bytes(50));

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
            }


            $id = UsersModel::insert($column, $columnValue);

            $userDir = ABS_PATH.IMAGES_PATH .'adv'.DS.$id;
            mkdir($userDir);


            try{

                $link = $this->route->baseUrl().'users/activation/'.$userData['code'];
                $name = $userData['first_name'] . ' ' . $userData['last_name'];

                $this->mail->setFrom(USER, NAME);
                $this->mail->addAddress($this->request->post('email'));
                $this->mail->Subject = 'Email verify';
                $this->mail->isHTML(true);
                $this->mail->Body = EmailFormat::format($name, $link);

                $this->mail->send();

                $data['status'] = 'success';
                $data['msg'] = 'تم التسجيل بنجاح فضلا قم بتفحص بريدك الإلكتروني للتفعيل';
                echo json_encode($data);
            } catch (Exception $e) {

                $data['status'] = 'error';
                $data['msg'] = 'لم يتم إرسال البريد الإلكتروني قم بالتأكد من صحة البريد الإلكتروني';
                echo json_encode($data);
            }




        } else {
            header('location:' . $this->route->baseUrl());
            exit();
        }

    }

}