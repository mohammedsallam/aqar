<?php
namespace Controllers;

use Models\ContactModel;

class ContactController extends Controller
{
    public function home()
    {

        if (! $this->session->get('user_email')){
            header('location:' . $this->route->baseUrl());
            exit();
        }

        $userData['full_name'] = $this->filter->stringStrip($this->request->post('full_name'));
        $userData['user_email'] = $this->filter->email($this->request->post('user_email'));
        $userData['message'] = $this->filter->stringStrip($this->request->post('message'));

        if ($this->request->requestMethod() == 'POST'){


            if (empty($userData['full_name']) == true){
                $data['status'] = 'error';
                $data['msg'] = 'Please userlogin';
                echo json_encode($data);
                exit();
            }


            if (empty($userData['user_email']) == true){
                $data['status'] = 'error';
                $data['msg'] = 'Please userlogin';
                echo json_encode($data);
                exit();
            }


            if (empty($userData['message']) == true){
                $data['status'] = 'error';
                $data['msg'] = 'Please type your message';
                echo json_encode($data);
                exit();
            }


            foreach ($userData as $key => $value) {

                $column[] = $key;
                $columnValue[] = $value;

                $this->session->set($key, $value);
            }

            ContactModel::insert( $column, $columnValue);

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
            $data['msg'] = 'Your message send successfully';
            echo json_encode($data);
            exit();

        }

    }

}