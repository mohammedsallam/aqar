<?php
namespace Controllers;


class IndexController extends Controller
{
    public $noLoad = ['content'];

    public function home()
    {
//        if ($this->session->get('email')){
//            header('location:' . $this->route->baseUrl() . 'userlogin');
//            exit();
//        }

        $this->app->container['title'] = 'Estrahaty | استراحتي';
        $this->siteView();

    }

}