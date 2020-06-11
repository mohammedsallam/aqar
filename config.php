<?php

define('PS', PATH_SEPARATOR);
define('DS', DIRECTORY_SEPARATOR);
define('PHP_PATH', get_include_path());
define('APP_PATH', realpath(__DIR__).DS.'App'.DS);
define('CORE_PATH',  realpath(__DIR__).DS.'Core'.DS);
define('ABS_PATH', realpath(__DIR__) . DS);
define('VIEWS_PATH',  APP_PATH . 'Views' . DS );
define('IMAGES_PATH', 'public'.DS.'images'.DS);
define('ADMIN_CSS',  'public'.DS.'css'.DS.'admin'.DS);
define('ADMIN_JS',  'public'.DS.'js'.DS.'admin'.DS.'');
define('SITE_CSS',  'public'.DS.'css'.DS.'site'.DS);
define('SITE_JS',  'public'.DS.'js'.DS.'site'.DS);
define('ADMIN_TEMPLATE_PATH', 'public' . DS . 'template' . DS . 'admin' . DS);
define('SITE_TEMPLATE_PATH', 'public' . DS . 'template' . DS . 'site' . DS);
//set_include_path(PHP_PATH.PS.APP_PATH.PS.CORE_PATH);


// Database information

define('HOST', 'localhost');
define('DB_NAME', 'aqar');
define('DB_USER', 'root');
define('DB_PASS', '');


// SMTP config

define('Host', 'smtp.gmail.com');
define('PORT', 465);
define('USER', 'mosallam06@gmail.com');
define('NAME', $_SERVER['HTTP_HOST']);
define('PASS', 'thggiodvpht/h0530345592');
