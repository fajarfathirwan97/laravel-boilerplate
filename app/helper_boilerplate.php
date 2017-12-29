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

if (!function_exists('transformToOptionHTML') )
{
    function transformToOptionHTML($arrays){
        $result = '';
        foreach($arrays as $key => $value){
            $result .= "<option value='{$key}'>$value</option>";
        }
        return $result;
    }
}

if (!function_exists('getSidebar') )
{
    function getSidebar(){
        $menu = new App\Models\Menu;
        $data = $menu->where('is_parent',1)->get();
        $data->transform(function($item,$key)use($menu){
            $item->child = $menu->where('parent_id',$item->id)->get();
            return $item;
        });
        return $data;
    }
}