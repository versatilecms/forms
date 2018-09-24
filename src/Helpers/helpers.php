<?php

if (!function_exists('forms')) {
    function forms($key, $default = null)
    {
        $forms = new \Versatile\Forms\Forms();
        
        return $forms->forms($key, $default);
    }
}
