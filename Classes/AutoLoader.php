<?php

class AutoLoader {
    public static function register() {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($fqcn) {
        $path = str_replace('\\', '/', $fqcn);
        $file = __DIR__ . '/' . $path . '.php';
    

    
        if (file_exists($file)) {
            require $file;
        } else {
            throw new Exception("Fichier introuvable pour la classe : $fqcn (chemin attendu : $file)");
        }
    }
    
}

// Enregistrement de l'autoloader
AutoLoader::register();
