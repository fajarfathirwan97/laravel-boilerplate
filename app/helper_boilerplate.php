<?php

if (!function_exists('translateUrl') )
{
    function translateUrl(){
        return trans("route.".\Request::route()->getName());
    }
}

if (!function_exists('getFirstNameLastname') )
{
    function getFirstNameLastname(){
        return \Sentinel::check()->first_name . ' ' . \Sentinel::check()->last_name;
    }
}

if (!function_exists('isNullAndEmpty') )
{
    function isNullAndEmpty($string){
        return empty($string) && is_null($string);
    }
}