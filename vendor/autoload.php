<?php

spl_autoload_register(function ($class) {
    $classPath = str_replace('\\', '/', $class);

    if(file_exists($classPath.'.php'))
        require_once "$classPath.php";
    else
        exit('File '.$classPath.' not found');
});