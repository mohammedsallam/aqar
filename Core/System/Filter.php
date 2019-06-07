<?php

namespace System;


class Filter
{
    public function int($var)
    {
        $var = (int) $var;
        $var = filter_var($var, FILTER_SANITIZE_NUMBER_INT);
        return $var;
    }

    public function stringStrip($var)
    {
        $var = filter_var($var, FILTER_SANITIZE_STRING);
        return $var;
    }

    public function string($var)
    {
        $var = htmlentities($var);
        $var = strip_tags($var);
        $var = filter_var($var, FILTER_SANITIZE_STRING);
        return $var;
    }

    public function email($var)
    {
        $var = filter_var($var, FILTER_VALIDATE_EMAIL);
        return $var;
    }

    public function password($var)
    {
        $var = htmlentities($var);
        return $var;
    }
}