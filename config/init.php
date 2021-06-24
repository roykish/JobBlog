<?php

//this piece of code is for auto loading all the classes automatically whenever an instance has been create of a particular class.

spl_autoload_register('myAutoLoad');

function myAutoLoad($className){
    $path = "lib/";
    $extension = ".php";
    $fullPath = $path. $className .$extension;

    include_once $fullPath;
}

?>