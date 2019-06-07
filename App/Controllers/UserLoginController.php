<?php
namespace Controllers;

use Models\UsersModel;

class UserLoginController extends Controller
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

        $this->app->container['title'] = 'تسجيل الدخول';
        $this->siteView();
    }

    public function check()
    {

        $userEmail = $this->filter->email($this->request->post('email'));
        $userPassword = $this->filter->password($this->request->post('password'));

        $user = UsersModel::getBy('email', $userEmail);

        if ($this->request->requestMethod() == 'POST') {

            if ($userEmail == false){
                $data['status'] = 'error';
                $data['msg'] = 'صيغة البريد الإلكتروني غير صالحة';
                echo json_encode($data);
                exit();
            }

            if(empty($userPassword) == true){
                $data['status'] = 'error';
                $data['msg'] = 'فضلا قم بإدخال كلمة المرور ';
                echo json_encode($data);
                exit();
            }

            if($user == null){
                $data['status'] = 'error';
                $data['msg'] = 'بيانات الاعتماد هذه غير متطابقة مع البيانات المسجلة لدينا.';
                echo json_encode($data);
                exit();
            }

            if ($user->verified == 0){
                $data['status'] = 'error';
                $data['msg'] = 'فضلا قم بتفعيل البريد الإلكتروني';
                echo json_encode($data);
                exit();
            }

            $password = $userPassword.'!@#$%^&*()';


            if (password_verify($password, $user->password) == false){
                $data['status'] = 'error';
                $data['msg'] = 'كلمة المرور غير صحيحة';
                echo json_encode($data);
                exit();
            }



            if ($this->request->post('remember') == 1){

                $this->cookie->set('email', $user->email, time()+3600);
                $this->cookie->set('id', $user->id, time()+3600);
                $this->cookie->set('first_name', $user->first_name, time()+3600);
                $this->cookie->set('last_name', $user->last_name, time()+3600);
            } else {

                $this->session->set('email', $user->email);
                $this->session->set('id', $user->id);
                $this->session->set('first_name', $user->first_name);
                $this->session->set('last_name', $user->last_name);

            }


            $data['status'] = 'success';
            $data['url'] = $_SERVER['HTTP_HOST'];
            $data['msg'] = 'تم تسجيل الدخول بنجاح';
            echo json_encode($data);
            exit();
        } else {
            header('location:' . $this->route->baseUrl());
            exit();
        }

    }


}