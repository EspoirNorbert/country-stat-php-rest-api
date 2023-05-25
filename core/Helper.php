<?php
namespace Core;

class Helper {

    public static function debug($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die();
    }
}