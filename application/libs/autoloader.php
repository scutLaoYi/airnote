<?php

function __autoload($className)
{
    $hasLoaded = False;
    $loadFromDir = function ($path) use ($className, &$hasLoaded) {
        $pathToClass = $path . $className . '.php';
        if (file_exists($pathToClass)) {
            require_once $pathToClass;
            $hasLoaded = True;
        }
    };

    $pathArray = array (
            LIB_PATH,
            CONTROLLER_PATH,
            VIEW_PATH,
            MODEL_PATH,
            TEMPLATE_PATH,
            SERVICE_PATH,
            COMMON_PATH,
            COMPONENT_PATH,
            );
    array_walk($pathArray, $loadFromDir);

    if (!$hasLoaded) {
        throw new Exception("Unable to load the class $className");
    }
}


