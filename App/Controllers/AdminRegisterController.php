<?php
namespace Controllers;

use Models\AdminModel;
use Models\UsersModel;
use System\EmailFormat;
use System\PHPMailer\Exception;

class AdminRegisterController extends Controller
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

        if ($this->session->has('admin_id') || $this->cookie->has('admin_id')){
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
//        $userData['phone'] = $this->filter->string($this->request->post('phone'));
        $userData['password'] = $this->filter->password($this->request->post('password'));
        $userData['password_conf'] = $this->filter->password($this->request->post('password_conf'));

        $email = $userData['email'];
//        $phone = $userData['phone'];

        $sql = "SELECT * FROM admins WHERE email = '$email'" ;

        $user = AdminModel::query($sql);


        if ($this->request->requestMethod() == 'POST') {

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

//            if (!$userData['phone']){
//                $data['status'] = 'error';
//                $data['msg'] = 'رقم الجوال لا يقل عن 10 أرقام ولا يزيد عن 14 رقم';
//                echo json_encode($data);
//                exit();
//            }

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

//            $userData['code'] = md5(random_bytes(50)).md5(random_bytes(50));

            foreach ($userData as $key => $value) {

                $column[] = $key;
                $columnValue[] = $value;
            }


            AdminModel::insert($column, $columnValue);

//            try{
//
//                $link = $this->route->baseUrl().'users/activation/'.$userData['code'];
//                $name = $userData['first_name'] . ' ' . $userData['last_name'];
//
//                $this->mail->setFrom(USER, NAME);
//                $this->mail->addAddress($this->request->post('email'));
//                $this->mail->Subject = 'Email verify';
//                $this->mail->isHTML(true);
//                $this->mail->Body = EmailFormat::format($name, $link);
//
//                $this->mail->send();
//
//                $data['status'] = 'success';
//                $data['msg'] = 'تم التسجيل بنجاح فضلا قم بتفحص بريدك الإلكتروني للتفعيل';
//
//            } catch (Exception $e) {
//
//                $data['status'] = 'error';
//                $data['msg'] = 'لم يتم إرسال البريد الإلكتروني قم بالتأكد من صحة البريد الإلكتروني';
//
//            }


            $data['status'] = 'success';
            $data['msg'] = 'تم التسجيل بنجاح';
            echo json_encode($data);
            exit();
        } else {
            header('location:' . $this->route->baseUrl());
            exit();
        }

    }

}