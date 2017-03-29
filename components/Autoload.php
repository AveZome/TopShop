<?php

/**
 * Function __autoload for the automatically connect classes
 */
function __autoload($class_name)
{
    // An array of folders in which the necessary classes can be located
    $array_paths = array(
        '/models/',
        '/components/',
        '/controllers/',
    );

    // list array paths
    foreach ($array_paths as $path) {

        // Form the name and way to file with class
        $path = ROOT . $path . $class_name . '.php';

        // If this file exist, connect it
        if (is_file($path)) {
            include_once $path;
        }
    }
}
