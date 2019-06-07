<?php
namespace System;

class AdminTemplate
{
    /**
     * Application
     * @var Application
     */

    public $app;

    /**
     * Loader constructor.
     *
     * @param Application $app
     */

    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    /**
     * Load head lay out
     *
     * @return void
     */

    public function loadHeadStart()
    {
        $file = ADMIN_TEMPLATE_PATH . 'head_start.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Css resources
     *
     * @return array
     */

    public function cssResources()
    {
       return [
           'bootstrap'      => $this->route->baseUrl() . ADMIN_CSS .'bootstrap.min.css',
           'dataTables.bootstrap'      => $this->route->baseUrl() . ADMIN_CSS .'dataTables.bootstrap.min.css',
           'font-awesome'          => $this->route->baseUrl() . ADMIN_CSS . 'font-awesome.min.css',
           'ioni'        => $this->route->baseUrl() . ADMIN_CSS . 'ionicons.min.css',
           'adminlt'        => $this->route->baseUrl() . ADMIN_CSS . 'AdminLTE.min.css',
           'skin'          => $this->route->baseUrl() . ADMIN_CSS . '_all-skins.min.css',
//           'morris'          => $this->route->baseUrl() . ADMIN_CSS . 'morris.css',
//           'jvectormap'          => $this->route->baseUrl() . ADMIN_CSS . 'jquery-jvectormap.css',
//           'datepicker'          => $this->route->baseUrl() . ADMIN_CSS . 'bootstrap-datepicker.min.css',
//           'daterangepicker'        => $this->route->baseUrl() . ADMIN_CSS . 'daterangepicker.css',
//           'wysihtml5'          => $this->route->baseUrl() . ADMIN_CSS . 'bootstrap3-wysihtml5.min.css',
           'googlefont'          => $this->route->baseUrl() . ADMIN_CSS . 'google.font.css',
           'select2'          => $this->route->baseUrl() . ADMIN_CSS . 'select2.min.css',
//           'lightbox'          => $this->route->baseUrl() . ADMIN_CSS . 'lightbox.min.css',
//           'nivo'          => $this->route->baseUrl() . ADMIN_CSS . 'nivo-lightbox.css',
           'pgwslider'          => $this->route->baseUrl() . ADMIN_CSS . 'pgwslider.min.css',
           'style'       => $this->route->baseUrl() . ADMIN_CSS . 'style.css',
       ];
    }


    /**
     * Load css resources
     *
     * @return void
     */

    public function loadCssResources()
    {

//        if ($this->app->controller == Application::NOT_FOUND_CONTROLLER){
//
//            $class = Application::NOT_FOUND_CONTROLLER;
//        } else {
//            $class = Route::CONTROLLERS_NAMESPACE . ucfirst($this->app->controller) . 'Controller';
//        }
//
//        $class = new $class($this->app);
        $cssResources = $this->cssResources();

        if (property_exists(get_called_class(), 'loadCss')){
            for ($i = 0; $i < count($this->loadCss); $i++){
                if (array_key_exists($this->loadCss[$i], $cssResources)){ ?>
                    <link rel="stylesheet" href="<?= $cssResources[$this->loadCss[$i]] ?>">
                <?php }
            }
        } else {
            foreach ($cssResources as $key => $value) { ?>
                <link rel="stylesheet" href="<?= $value ?>">
            <?php }
        }

    }

    /**
     * Load head end
     *
     * @return  void
     */

    public function loadHeadEnd()
    {
        $file = ADMIN_TEMPLATE_PATH . 'head_end.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }

    public function LoadBodyStart()
    {
        $file = ADMIN_TEMPLATE_PATH . 'body_start.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }

    public function wrapperStart()
    {
        $file = ADMIN_TEMPLATE_PATH . 'wrapper_start.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Load body end
     *
     * @return  void
     */

    public function nav()
    {
        $file = ADMIN_TEMPLATE_PATH . 'nav.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Load loader end
     *
     * @return  void
     */

    public function loader()
    {
        $file = ADMIN_TEMPLATE_PATH . 'loader.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Load overlay end
     *
     * @return  void
     */

    public function overlay()
    {
        $file = ADMIN_TEMPLATE_PATH . 'overlay.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }



    /**
     * Load sides section end
     *
     * @return  void
     */

    public function aSide()
    {
        $file = ADMIN_TEMPLATE_PATH . 'aside.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    public function startContentWrapper()
    {
        $file = ADMIN_TEMPLATE_PATH . 'start_content_wrapper.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    public function startMainContent()
    {
        $file = ADMIN_TEMPLATE_PATH . 'start_main_content.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }

    public function endMainContent()
    {
        $file = ADMIN_TEMPLATE_PATH . 'end_main_content.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    public function footer()
    {
        $file = ADMIN_TEMPLATE_PATH . 'footer_section.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    public function controlSideBar()
    {
        $file = ADMIN_TEMPLATE_PATH . 'control_sidebar.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    public function wrapEnd()
    {
        $file = ADMIN_TEMPLATE_PATH . 'wrapper_end.php';
        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    /**
     * Js resources
     *
     * @return array
     */

    public function jsResources()
    {
        return [
            'jquery'    => $this->route->baseUrl() . ADMIN_JS . 'jquery.min.js',
            'jquery-ui.min.js' => $this->route->baseUrl() . ADMIN_JS . 'jquery-ui.min.js',
            'bootstrap' => $this->route->baseUrl() . ADMIN_JS . 'bootstrap.min.js',
            'jquery.dataTables' => $this->route->baseUrl() . ADMIN_JS . 'jquery.dataTables.min.js',
            'dataTables.bootstrap' => $this->route->baseUrl() . ADMIN_JS . 'dataTables.bootstrap.min.js',
//            'raphael'    => $this->route->baseUrl() . ADMIN_JS . 'jraphael.min.js',
//            'morris'    => $this->route->baseUrl() . ADMIN_JS . 'morris.min.js',
//            'sparkline'  => $this->route->baseUrl() . ADMIN_JS . 'jquery.sparkline.min.js',
//            'jquery-jvectorma'  => $this->route->baseUrl() . ADMIN_JS . 'jquery-jvectormap-1.2.2.min.js',
//            'jquery-jvectorma-world'  => $this->route->baseUrl() . ADMIN_JS . 'jquery-jvectormap-world-mill-en.js',
//            'jquery.knob.min.js'  => $this->route->baseUrl() . ADMIN_JS . 'jquery.knob.min.js',
//            'moment.min.js'  => $this->route->baseUrl() . ADMIN_JS . 'moment.min.js',
//            'daterangepicker.js'  => $this->route->baseUrl() . ADMIN_JS . 'daterangepicker.js',
//            'bootstrap-datepicker.min.js'  => $this->route->baseUrl() . ADMIN_JS . 'bootstrap-datepicker.min.js',
//            'bootstrap3-wysihtml5.all.min.js'      => $this->route->baseUrl() . ADMIN_JS . 'bootstrap3-wysihtml5.all.min.js',
//            'jquery.slimscroll.min.js'      => $this->route->baseUrl() . ADMIN_JS . 'jquery.slimscroll.min.js',
//            'fastclick.js'      => $this->route->baseUrl() . ADMIN_JS . 'fastclick.js',
            'adminlte.min.js'      => $this->route->baseUrl() . ADMIN_JS . 'adminlte.min.js',
            'dashboard.js'      => $this->route->baseUrl() . ADMIN_JS . 'dashboard.js',
            'demo.js'      => $this->route->baseUrl() . ADMIN_JS . 'demo.js',
            'select2'      => $this->route->baseUrl() . ADMIN_JS . 'select2.min.js',
//            'nivo'      => $this->route->baseUrl() . ADMIN_JS . 'nivo-lightbox.min.js',
            'pgwslider'      => $this->route->baseUrl() . ADMIN_JS . 'pgwslider.min.js',
            'main'      => $this->route->baseUrl() . ADMIN_JS . 'main.js',
        ];
    }


    /**
     * Load js resources
     *
     * @return void
     */

    public function loadJsResources()
    {

//        if ($this->app->controller == Application::NOT_FOUND_CONTROLLER){
//
//            $class = Application::NOT_FOUND_CONTROLLER;
//        } else {
//            $class = Route::CONTROLLERS_NAMESPACE . ucfirst($this->app->controller) . 'Controller';
//        }
//
//        $class = new $class($this->app);

        $jsResources = $this->jsResources();

        if (property_exists(get_called_class(), 'loadJs')){
            for ($i = 0; $i < count($this->loadJs); $i++){
                if (array_key_exists($this->loadJs[$i], $jsResources)){ ?>
                    <script src="<?= $jsResources[$this->loadJs[$i]] ?>"></script>
                <?php }
            }
        } else {

            foreach ($jsResources as $key => $value) { ?>
                <script src="<?= $value ?>"></script>
            <?php }

        }
    }



    public function loadBodyEnd()
    {
        $file = ADMIN_TEMPLATE_PATH . 'body_end.php';

        if (file_exists($file)){
            extract($this->app->container);
            require_once $file;
        }
    }


    public function __get($name)
    {
        return $this->app->$name;
    }

}