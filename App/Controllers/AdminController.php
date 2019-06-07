<?php
namespace Controllers;

use Models\AdminModel;
use Models\AdvertiseModel;
use Models\LocationModel;
use Models\UsersModel;

class AdminController extends Controller
{

    public function home(){

        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $this->app->container['title'] = 'Admin | Dashboard page';
        $this->adminView();
    }

    public function allUsers()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $this->app->container['title'] = 'كل المستخدمين';
        $this->adminView();
    }

    public function addUser()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $this->app->container['title'] = 'إضافة مستخدم';
        $this->adminView();
    }

    public function allAdv()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $this->app->container['title'] = 'كل الإعلانات';
        $this->adminView();
    }

    public function addAdv()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $this->app->container['title'] = 'إضافة إعلان';
        $this->adminView();

    }

    public function moreAdv()
    {

        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $id = $this->filter->int($this->app->params);
        $sql = "SELECT advertises.*, users.*, adv_img.* FROM adv_img LEFT JOIN advertises ON advertises.id = adv_img.adv_id LEFT JOIN users ON users.id = advertises.user_id WHERE adv_img.adv_id = $id";
        $adv = AdvertiseModel::query($sql);
        $adv = array_shift($adv);
        $this->app->container['title'] = 'إضافة إعلان';
        $this->app->container['adv'] = $adv;
        $this->adminView();

    }

    public function allCities()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $allCities = LocationModel::getAll();

        $this->app->container['title'] = 'كل المدن';
        $this->app->container['allCities'] = $allCities;
        $this->adminView();
    }

    public function addCity()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $this->app->container['title'] = 'إضافة مدينة';
        $this->adminView();
    }

    public function editProfile()
    {

        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $adminData['id'] = $this->filter->int($this->request->post('id'));
        $adminData['first_name'] = $this->filter->stringStrip($this->request->post('first_name'));
        $adminData['last_name'] = $this->filter->stringStrip($this->request->post('last_name'));
        $adminData['email'] = $this->filter->email($this->request->post('email'));
        $adminData['password'] = $this->filter->password($this->request->post('password'));
        $adminData['password_conf'] = $this->filter->password($this->request->post('password_conf'));

        $id = $adminData['id'];

        if ($this->request->requestMethod() == 'POST'){

            $sql = "SELECT * FROM admins WHERE id != $id";

            $admin = AdminModel::query($sql);



           if (empty($admin) == false){
               foreach ($admin as $email) {

                   if ($email->admin_email == $this->request->post('email')){
                       $data['status'] = 'error';
                       $data['msg'] = 'البريد الإلكتروني موجود بالفعل';
                       echo json_encode($data);
                       exit();
                   }
               }
           }


            if (empty($adminData['first_name']) == true){
                $data['status'] = 'error';
                $data['msg'] = 'الإسم الأول لا يقل عن 2 أحرف';
                echo json_encode($data);
                exit();
            }

            if (empty($adminData['first_name']) == true){
                $data['status'] = 'error';
                $data['msg'] = 'الإسم الأخير لا يقل عن 2 أحرف';
                echo json_encode($data);
                exit();
            }

            if (mb_strlen($adminData['first_name']) < 3){
                $data['status'] = 'error';
                $data['msg'] = 'الإسم الأول لا يقل عن 2 أحرف';
                echo json_encode($data);
                exit();
            }

            if (mb_strlen($adminData['last_name']) < 3){
                $data['status'] = 'error';
                $data['msg'] = 'الإسم الأخير لا يقل عن 2 أحرف';
                echo json_encode($data);
                exit();
            }


            if ($adminData['email'] == false){
                $data['status'] = 'error';
                $data['msg'] = 'صيغة البريد الإلكتروني غير صالحة';
                echo json_encode($data);
                exit();
            }

            if (empty($adminData['password']) == false){

                if ($adminData['password'] == ''){
                    $data['status'] = 'error';
                    $data['msg'] = 'فضلا قم بكتابة كلمة المرور';
                    echo json_encode($data);
                    exit();
                }

                if ($adminData['password'] != $adminData['password_conf']){
                    $data['status'] = 'error';
                    $data['msg'] = 'كلمات المرور غير متطابقة';
                    echo json_encode($data);
                    exit();
                }

                if (mb_strlen($adminData['password']) < 8 || mb_strlen($adminData['password_conf']) < 8){
                    $data['status'] = 'error';
                    $data['msg'] = 'كلمات المرور لا تقل عن 8 أحرف';
                    echo json_encode($data);
                    exit();
                }


                $adminData['password'] = password_hash($adminData['password_conf'].'!@#$%^&*()', CRYPT_BLOWFISH);

            }

            if (empty($adminData['password_conf']) == false){
                if ($adminData['password'] == ''){
                    $data['status'] = 'error';
                    $data['msg'] = 'فضلا قم بكتابة كلمة المرور';
                    echo json_encode($data);
                    exit();
                }

            }

            unset($adminData['password_conf'], $adminData['id']);

            if ($adminData['password'] == ''){
                unset($adminData['password']);
            }


            foreach ($adminData as $key => $value) {

                $column[] = $key;
                $columnValue[] = $value;

                $this->session->set($key, $value);
            }

            AdminModel::update( $column, $columnValue, "id = $id");

            if ($this->request->post('admin_img')){
                $allow_ext  = array('jpg','jpeg','png','gif');
                $ext = explode('.', $_FILES['admin_img']['name']);
                $ext = end($ext);
                $ext = strtolower($ext);
                if(in_array($ext,$allow_ext)) {
                    $new_name = $this->request->post('admin_img');
                    move_uploaded_file($_FILES['admin_img']['tmp_name'], ABS_PATH . IMAGES_PATH . $new_name);
                } else {
                    $data['status'] = 'error';
                    $data['msg'] = 'ملف غير مسموح به';
                    echo json_encode($data);
                    exit();
                }
            }

            $data['status'] = 'success';
            $data['msg'] = 'تم التعديل بنجاح';
            echo json_encode($data);
            exit();

        }

    }

    public function oldUserPhoto()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $this->app->container['title'] = 'صور قديمة';
        $this->adminView();
    }

    public function deleteOldUserPhoto()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }



        $sql = "SELECT user_img FROM users ";
        $photo = UsersModel::query($sql);

        $img = [];


        if ($this->request->post('entry')){

            $imgToDelete = $this->request->post('entry');
            $targetDir = ABS_PATH.IMAGES_PATH .'users_profile'.DS;
            $open = opendir($targetDir);
            readdir($open);
            unlink($targetDir.$imgToDelete);
            $data['status'] = 'success';
            $data['msg'] = 'تم حذف الصورة بنجاح';
            echo json_encode($data);
            closedir($open);

        } elseif($this->request->post('delAll')){
            $targetDir = ABS_PATH.IMAGES_PATH .'users_profile'.DS;
            $open = opendir($targetDir);

            foreach ($photo as $item) {
                array_push($img, $item->user_img);
            }

            while (false !== ($entry = readdir($open))){
                if ($entry != '.' && $entry != '..'){

                    if (!in_array($entry, $img)){

                        unlink($targetDir.$entry);
                    }

                }
            }

            $data['status'] = 'success';
            $data['msg'] = 'تم حذف كل الصور';
            echo json_encode($data);

            closedir($open);
        }

    }

}