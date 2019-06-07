<?php


namespace System;


class EmailFormat
{
    public $name;
    public $link;

    public static function format($name, $link)
    {
        $message = "<div><img style='    width: 16%;
    border-radius: 10px;' src='http://placehold.it/200/200'>";
        $message .= "<h1 style='font-family: Tahoma;
    background: #03b303;
    width: 31%;
    border-radius: 5px;
    color: #fff;
    display: flex;
    padding: 0 0 4px;
    justify-content: center'>تفعيل البريد الإلكتروني</h1>";
        $message .= "<h2>مرحبا $name </h2>";
        $message .= "<h2> فضلا قم بالضغط على الرابط أدناه للتفعيل  </h2>";
        $message .= "<a style='background: blue;
    color: #fff;
    font-size: 20px;
    font-family: Tahoma;
    padding: 10px;
    border-radius: 5px;
    display: flex;
    text-decoration: none;
    width: 10%;
    justify-content: center;' target='_blank' href= '$link' class='btn btn-primary'>تفعيل الآن</a></div>";
        return  $message;
    }
}