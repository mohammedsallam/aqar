<?php
namespace Controllers;

use Models\AdminModel;
use Models\UsersModel;

class AdminLoginController extends Controller
{

//    public $noLoad = [
//        'wrapStart',
//        'nav',
//        'aSide',
//        'controlSideBar',
//        'controlSideBarBg',
//        'wrapperEnd',
//    ];

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

    public function home(){

        if ($this->session->has('admin_id') || $this->cookie->has('admin_id')){
            header('location:' . $this->route->baseUrl() . 'Admin/home');
            exit();
        }

        $this->app->container['title'] = 'Admin login page';
        $this->siteView();
    }

    public function check()
    {

        $adminEmail = $this->filter->email($this->request->post('email'));
        $adminPassword = $this->filter->password($this->request->post('password'));

        $admin = AdminModel::getBy('email', $adminEmail);

        if ($this->request->requestMethod() == 'POST') {

            if ($adminEmail == false){
                $data['status'] = 'error';
                $data['msg'] = 'صيغة البريد الإلكتروني غير صالحة';
                echo json_encode($data);
                exit();
            }

            if(empty($adminPassword) == true){
                $data['status'] = 'error';
                $data['msg'] = 'فضلا قم بإدخال كلمة المرور ';
                echo json_encode($data);
                exit();
            }

            if($admin == null){
                $data['status'] = 'error';
                $data['msg'] = 'بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا.';
                echo json_encode($data);
                exit();
            }

//            if ($admin->verified == 0){
//                $data['status'] = 'error';
//                $data['msg'] = 'فضلا قم بتفعيل رقم الجوال';
//                echo json_encode($data);
//                exit();
//            }


            $password = $adminPassword.'!@#$%^&*()';


            if (password_verify($password, $admin->password) == false){
                $data['status'] = 'error';
                $data['msg'] = 'كلمة المرور غير صحيحة';
                echo json_encode($data);
                exit();
            }


            if ($this->request->post('remember') == 1){

                $this->cookie->set('admin_email', $admin->email, time()+3600);
                $this->cookie->set('admin_id', $admin->id, time()+3600);
                $this->cookie->set('admin_first_name', $admin->first_name, time()+3600);
                $this->cookie->set('admin_last_name', $admin->last_name, time()+3600);
            } else {

                $this->session->set('admin_email', $admin->email);
                $this->session->set('admin_id', $admin->id);
                $this->session->set('admin_first_name', $admin->first_name);
                $this->session->set('admin_last_name', $admin->last_name);

            }


            $data['status'] = 'success';
            $data['msg'] = 'تم تسجيل الدخول بنجاح';
            echo json_encode($data);
            exit();
        }


    }

}