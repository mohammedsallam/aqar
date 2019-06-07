<?php
namespace Controllers;

use System\Application;

class Controller
{

    public $app;


    /**
     * Controller constructor.
     *
     * @param Application $app
     */

    public function __construct(Application $app)
    {
        $this->app = $app;

    }

    /**
     * Not found method
     *
     * @return void
     */

    public function notFoundAdmin()
    {
        if (!$this->session->has('admin_id')){

            if (!$this->cookie->has('admin_id') ){
                header('location:' . $this->route->baseUrl() . 'AdminLogin');
                exit();
            }
        }
        $this->app->container['title'] = '404 Page not found';
        $this->adminView();

    }

    public function notFoundSite()
    {
        $this->app->container['title'] = '404 Page not found';
        $this->siteView();

    }



    /**
     * Render Admin view
     *
     * @return void
     */

    public function adminView()
    {

        if ($this->app->action == Application::NOT_FOUND_ADMIN_ACTION){
            $view = VIEWS_PATH . 'notfound' . DS . 'notfound_view.php';
        } else {
            $view = VIEWS_PATH . str_replace(['-', '_'], ['', ''], strtolower($this->app->controller)) . DS . strtolower($this->app->action) . '_view.php';
            if (! file_exists($view)){
                $view = VIEWS_PATH . 'notfound' . DS . 'noview_view.php';
            }
        }


        $loadedTemplateBefore = [
            'loadHeadStart'     => 'loadHeadStart',
            'loadCssResources'  => 'loadCssResources',
            'loadHeadEnd'     => 'loadHeadEnd',
            'LoadBodyStart'     => 'LoadBodyStart',
            'wrapperStart'       => 'wrapperStart',
            'nav'     => 'nav',
            'loader'        => 'loader',
            'overlay'       => 'overlay',
            'aSide'        => 'aSide',
            'startContentWrapper'  => 'startContentWrapper',
            'startMainContent'  => 'startMainContent'
        ];

        if (property_exists(get_called_class(), 'noLoad')){
            for ($i = 0; $i < count($this->noLoad); $i++){
                if (array_key_exists($this->noLoad[$i], $loadedTemplateBefore)){
                    unset($loadedTemplateBefore[$this->noLoad[$i]]);
                }
            }
        }

        foreach ($loadedTemplateBefore as $key => $value) {
            $this->adminTemp->$value();
        }


        extract($this->app->container);
        require_once $view;

        $loadedTemplateAfter = [
            'endMainContent' => 'endMainContent',
            'controlSideBar' => 'controlSideBar',
            'wrapEnd' => 'wrapEnd',
            'footer'  => 'footer',
            'loadJsResources' => 'loadJsResources',
            'loadBodyEnd' => 'loadBodyEnd',
        ];

        if (property_exists(get_called_class(), 'noLoad')){
            for ($i = 0; $i < count($this->noLoad); $i++){
                if (array_key_exists($this->noLoad[$i], $loadedTemplateAfter)){
                    unset($loadedTemplateAfter[$this->noLoad[$i]]);
                }
            }
        }

        foreach ($loadedTemplateAfter as $key => $value) {
            $this->adminTemp->$value();
        }

    }

    /**
     * Render Admin view
     *
     * @return void
     */

    public function siteView()
    {

        if ($this->app->action == Application::NOT_FOUND_SITE_ACTION){
            $view = VIEWS_PATH . 'notfound' . DS . 'notfound_view.php';
        } else {
            $view = VIEWS_PATH . str_replace(['-', '_'], ['', ''], strtolower($this->app->controller)) . DS . strtolower($this->app->action) . '_view.php';
            if (! file_exists($view)){
                $view = VIEWS_PATH . 'notfound' . DS . 'noview_view.php';
            }
        }


        $loadedTemplateBefore = [
            'headStart'     => 'loadHeadStart',
            'cssResources'  => 'loadCssResources',
            'headEnd'       => 'loadHeadEnd',
            'bodyStart'     => 'bodyStart',
            'loader'        => 'loader',
            'overlay'       => 'overlay',
            'slider' => 'slider',
            'navBar' => 'navBar',
        ];

        if (property_exists(get_called_class(), 'noLoad')){
            for ($i = 0; $i < count($this->noLoad); $i++){
                if (array_key_exists($this->noLoad[$i], $loadedTemplateBefore)){
                    unset($loadedTemplateBefore[$this->noLoad[$i]]);
                }
            }
        }


        foreach ($loadedTemplateBefore as $key => $value) {
            $this->siteTemp->$value();
        }


        extract($this->app->container);
        require_once $view;

        $loadedTemplateAfter = [
//            'content' => 'content',
//            'contentNext' => 'contentNext',
            'footerSection' => 'footerSection',
//            'contentEnd' => 'contentEnd',
            'loadJsResources' => 'loadJsResources',
            'loadBodyEnd'     => 'loadBodyEnd',
        ];

        if (property_exists(get_called_class(), 'noLoad')){
            for ($i = 0; $i < count($this->noLoad); $i++){
                if (array_key_exists($this->noLoad[$i], $loadedTemplateAfter)){
                    unset($loadedTemplateAfter[$this->noLoad[$i]]);
                }
            }
        }

        foreach ($loadedTemplateAfter as $key => $value) {
            $this->siteTemp->$value();
        }

    }


    /**
     * Get core classes directly
     *
     * @param $name
     * @return mixed
     */

    public function __get($name)
    {
        return $this->app->$name;
    }

}