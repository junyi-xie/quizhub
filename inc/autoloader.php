<?php

    /**
     * Function to autoload classes. This helps save time with the amount of requires/includes for  the classes.
     * 
     * @link [https://tutorials.supunkavinda.blog/php/oop-autoloading]
     */
    spl_autoload_register(function($className) {
        $file = dirname(__DIR__) . '\\src\\' . $className . '.php';
        $file = str_replace('\\', DIRECTORY_SEPARATOR, $file);

        if ( file_exists($file) ) {
            require_once $file;
        }
    });