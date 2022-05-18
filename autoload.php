<?php
spl_autoload_register(function($class) {
    if(file_exists('Services/' . $class . '.php')) {
        require_once 'Services/' . $class . '.php';
    }
});