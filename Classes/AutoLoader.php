<?php

class AutoLoader {
    public static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($fqcn) {
        $path = str_replace('\\', '/', $fqcn);
        require 'Classes/' . $path . '.php';
    }
    
}

?>