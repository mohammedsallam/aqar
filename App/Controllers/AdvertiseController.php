<?php
namespace Controllers;


use Models\AdvertiseModel;
use Models\AdvImgModel;
use System\ImageCompress;

class AdvertiseController extends Controller
{
    public $noLoad = ['content'];

    public function home()
    {
        if (!$this->session->has('id')){

            if (!$this->cookie->has('id') ){
                header('location:' . $this->route->baseUrl() . 'UserLogin');
                exit();
            }
        }

        if ($this->cookie->has('id')){
            $id = $this->cookie->get('id');
        } else {
            $id = $this->session->get('id');
        }

        $sql = "SELECT advertises.*, users.*, adv_img.* FROM adv_img LEFT JOIN advertises ON advertises.id = adv_img.adv_id LEFT JOIN users ON users.id = advertises.user_id WHERE advertises.user_id = $id";
        $allAdvs = AdvertiseModel::query($sql);
        $allAdvs = array_shift($allAdvs);


        $this->app->container['title'] = 'إعلاناتي | My Advertises';
        $this->app->container['allAdvs'] = $allAdvs;
        $this->siteView();



    }

    public function show()
    {
        $id = $this->filter->int($this->app->params);

        $sql = "SELECT advertises.*, users.*, adv_img.* FROM adv_img LEFT JOIN advertises ON advertises.id = adv_img.adv_id LEFT JOIN users ON users.id = advertises.user_id WHERE advertises.id = $id";
        $adv = AdvertiseModel::query($sql);
        $adv = array_shift($adv);

        $this->app->container['title'] = 'إعلاناتي | My Advertises';
        $this->app->container['adv'] = $adv;
        $this->siteView();



    }

    public function showForm(){

        if (!$this->session->has('id')){

            if (!$this->cookie->has('id') ){
                header('location:' . $this->route->baseUrl() . 'UserLogin');
                exit();
            }
        }

        if ($this->cookie->has('id')){
            $id = $this->cookie->get('id');
        } else {
            $id = $this->session->get('id');
        }

        $sql = "SELECT advertises.*, users.*, adv_img.* FROM adv_img LEFT JOIN advertises ON advertises.id = adv_img.adv_id LEFT JOIN users ON users.id = advertises.user_id WHERE advertises.user_id = $id";
        $allAdvs = AdvertiseModel::query($sql);
        $allAdvs = array_shift($allAdvs);


        $this->app->container['title'] = 'إعلاناتي - إضافة ';
        $this->app->container['allAdvs'] = $allAdvs;
        $this->siteView();
    }

    public function edit()
    {
        if (!$this->session->has('id')){

            if (!$this->cookie->has('id') ){
                header('location:' . $this->route->baseUrl() . 'UserLogin');
                exit();
            }
        }

        if ($this->cookie->has('id')){
            $id = $this->cookie->get('id');
        } else {
            $id = $this->session->get('id');
        }

        $sql = "SELECT advertises.*, users.*, adv_img.* FROM adv_img LEFT JOIN advertises ON advertises.id = adv_img.adv_id LEFT JOIN users ON users.id = advertises.user_id WHERE advertises.user_id = $id";
        $allAdvs = AdvertiseModel::query($sql);
        $allAdvs = array_shift($allAdvs);


        $this->app->container['title'] = 'إعلاناتي | تعديل';
        $this->app->container['allAdvs'] = $allAdvs;
        $this->siteView();
    }

    public function add()
    {


        $advData['title'] = $this->filter->stringStrip($this->request->post('title'));
        $advData['location'] = $this->filter->stringStrip($this->request->post('location'));
        $advData['user_id'] = $this->filter->int($this->request->post('user_id'));
        $advData['description'] = $this->filter->stringStrip($this->request->post('description'));
        $advData['size'] = $this->filter->int($this->request->post('size'));
        $advData['bath'] = $this->filter->int($this->request->post('bath'));
        $advData['room'] = $this->filter->int($this->request->post('room'));
        $advData['lat'] = $this->filter->stringStrip($this->request->post('lat'));
        $advData['lng'] = $this->filter->stringStrip($this->request->post('lng'));
        $advData['created_at'] = time();
        $images = $this->request->post('images');

        $userDir = $advData['user_id'];
        $id = $advData['user_id'];

        if ($this->request->requestMethod() == 'POST') {
            foreach ($advData as $key => $value) {
                if (empty($value)){
                    $data['status'] = 'error';
                    $data['msg'] = 'فضلا قم بملئ جميع الحقول';
                    echo json_encode($data);
                    exit();
                }
            }


            if(empty($images) == false){

                $images_adv = [];

                $targetDir = ABS_PATH.IMAGES_PATH .'adv'.DS.$userDir.DS;

                $open = opendir($targetDir);

                while (false !== ($entry = readdir($open))){
                    if ($entry != '.' && $entry != '..'){
                        unlink($targetDir.$entry);
                    }
                }

                closedir($open);

                $allowTypes = array('jpg','png','jpeg');

                foreach($_FILES['files']['tmp_name'] as $key => $val){

                    $fileName = basename($_FILES['files']['name'][$key]);

                    $ext = explode('.', $fileName);
                    $ext = end($ext);
                    $ext = strtolower($ext);

                    $fileName = md5(rand(0000, 9999)).'_'.md5(rand(0000, 9999)).'_.'.$ext;

                    $targetFilePath = $targetDir.$fileName;



                    if(exif_imagetype($_FILES['files']['tmp_name'][$key]) == false){
                        $data['status'] = 'error';
                        $data['msg'] = ' ملف صورة غير صالح '.$_FILES['files']['name'][$key];
                        echo json_encode($data);
                        exit();
                    }

                    if (!in_array($ext, $allowTypes)){
                        $data['status'] = 'error';
                        $data['msg'] = ' امتداد غير مسموح به '. $_FILES['files']['name'][$key];
                        echo json_encode($data);
                        exit();
                    }

                    array_push($images_adv,$fileName);

                    ImageCompress::compressImage($_FILES["files"]["tmp_name"][$key], $targetFilePath, 90);

//                move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath);

                }


            } else{
                $data['status'] = 'error';
                $data['msg'] = 'فضلاُ قم باختيار الصور';
                echo json_encode($data);
                exit();
            }

            foreach ($advData as $key => $value) {

                $column[] = $key;
                $columnValue[$key] = $value;

            }


            $userAdv = AdvertiseModel::getBy('user_id', $id);


            $advId = empty($userAdv) == false ? $userAdv->id : null;

            if(empty($userAdv) == false){
                $columnValue['created_at'] = $userAdv->created_at;
                AdvertiseModel::update($column, $columnValue, "user_id = $id");
                $images_adv = json_encode($images_adv);
                $sql = "UPDATE adv_img SET img = '$images_adv', adv_id = $advId WHERE adv_id = $advId";
                AdvImgModel::query($sql);

                $data['status'] = 'success';
                $data['msg'] = 'تم التعديل بنجاح';
            } else {
                $adv = AdvertiseModel::insert($column, $columnValue);
                $images_adv = json_encode($images_adv);
                $sql = "INSERT INTO adv_img SET img = '$images_adv', adv_id = $adv";
                AdvImgModel::query($sql);
                $data['status'] = 'success';
                $data['msg'] = 'تم رفع الإعلان بنجاح';
            }


            echo json_encode($data);
            exit();
        } else {
            header('location:'. $this->route->baseUrl());
            exit();
        }

    }

    public function delete()
    {

        $id = $this->request->post('id');

        $adv = AdvertiseModel::getBy('id', $id);

        if ($this->request->requestMethod() == 'POST') {
            if(empty($adv) == false){
                AdvertiseModel::delete("id = $id");

                $data['status'] = 'success';
                $data['msg'] = " تم حذف الإعلان رقم $id بنجاح ";
                echo json_encode($data);
            } else {
                $data['status'] = 'error';
                $data['msg'] = 'هذا الإعلان غير موجود';
                echo json_encode($data);
            }
        } else {
            header('location:'. $this->route->baseUrl());
            exit();
        }

    }

    public function searchResult()
    {

        $this->app->container['title'] = 'نتائج البحث';
        $this->siteView();
        }

}