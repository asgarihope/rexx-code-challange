<?php

namespace Helper;

class Helper
{
    static function dd(...$vars)
    {
        echo '<pre>';
        var_dump($vars);
        echo '</pre>';
        die;
    }

    static function view(string $layout){
        ob_start();
        include $layout;
        $content = ob_get_clean();

        include 'src/Views/layout.php';
    }
}