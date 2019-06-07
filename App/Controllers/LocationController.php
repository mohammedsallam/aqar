<?php
namespace Controllers;

use Models\AdminModel;
use Models\AdvertiseModel;
use Models\LocationModel;

class LocationController extends Controller
{

    public function editAndAdd()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }

        $cityData['city'] = $this->filter->stringStrip($this->request->post('city'));
        $id = $this->request->post('id') ? $this->request->post('id') : null;
        $city = $cityData['city'];


        if ($this->request->requestMethod() == 'POST') {

            if (mb_strlen($cityData['city']) == 0){
                $data['status'] = 'error';
                $data['msg'] = 'فضلاً قم بكتابة اسم المدينة';
                echo json_encode($data);
                exit();
            }

            $city = LocationModel::getBy('city', $city);

            if(empty($city) == false){
                $data['status'] = 'error';
                $data['msg'] = 'تمت إضافة المدينة مسبقاً';
                echo json_encode($data);
                exit();
            }


            foreach ($cityData as $key => $value) {

                $column[] = $key;
                $columnValue[] = $value;
            }

            if (empty($id) == false) {
                LocationModel::update($column, $columnValue, "id=$id");
                $data['status'] = 'success';
                $data['msg'] = 'تم تعديل المدينة بنجاح';
                echo json_encode($data);
                exit();
            }

            LocationModel::insert($column, $columnValue);
            $data['status'] = 'success';
            $data['msg'] = 'تم إضافة المدينة بنجاح';
            echo json_encode($data);
            exit();

        } else{
            header('location:'.$this->route->baseUrl());
            exit();
        }
    }

    public function delete()
    {

        $id = $this->request->post('id');

        $city = LocationModel::getBy('id', $id);

        if ($this->request->requestMethod() == 'POST') {
            if(empty($city) == false){
                LocationModel::delete("id = $id");

                $data['status'] = 'success';
                $data['msg'] = " تم حذف المدينة رقم $id بنجاح ";
                echo json_encode($data);
            } else {
                $data['status'] = 'error';
                $data['msg'] = 'هذه المدينة غير موجودة';
                echo json_encode($data);
            }
        } else{
            header('location:'.$this->route->baseUrl());
            exit();
        }
    }

    public function getCity()
    {
        $id = $this->request->post('id');
        $city = LocationModel::getBy('id', $id);

        if ($this->request->requestMethod() == 'POST') { ?>
            <!-- Alerts -->
            <div class="alert alert-success text-center success_msg hidden" role="alert"></div>
            <div class="alert alert-danger text-center error_msg hidden" role="alert"></div>
            <!-- End Alerts -->

            <form method="post" class="update_form" style="direction: rtl" action="<?= $this->route->baseUrl() . 'location/editAndAdd'?>">
                <input type="hidden" name="id" value="<?= $city->id ?>">
                <div class="form-group">
                    <input type="text" name="city" class="form-control" id="city"  placeholder="اسم المدينة" value="<?= $city->city ?>">
                    <small class="text-danger hidden">هذا الحقل مطلوب *</small>
                </div>
            </form>
        <?php } else{
            header('location:'.$this->route->baseUrl());
            exit();
        }

    }

}