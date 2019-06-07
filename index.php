<?php
require_once 'config.php';
require_once 'Core/helper.php';
require_once 'Core' . DS . 'System' . DS .'Application.php';

use System\Application;
$app = Application::getInstance();
$app->run();





//
//function pre($var){
//
//    echo '<pre>';
//    var_dump($var);
//    echo '</pre>';
//}
//
//
//
//pre(filetype('pdf.pdf'));
//if( mime_content_type ('pdf.pdf') == true){
//    echo 'true';
//}
//
//if (exif_imagetype('pdf.pdf') == IMAGETYPE_JPEG) {
//    echo 'The picture is not a gif';
//}
