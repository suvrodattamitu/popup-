<?php 

namespace NinjaPopups\Views;

class View 
{
    public static function make($path, $data = [])
    {
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        $file = NINJAPOPUPS_DIR.'app/Views/'.$path.'.php';
        ob_start();
        extract($data);
        include $file;
        return ob_get_clean();
    }

    public static function render($path, $data = [])
    {
        echo static::make($path, $data);
    }
}