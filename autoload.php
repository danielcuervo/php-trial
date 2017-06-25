<?php
function autoload($className) {
    $filename = __DIR__ . '/../'. str_replace("\\", "/", $className) . ".php";
    if (is_readable($filename)) {
        require $filename;
    }
}


spl_autoload_register("autoload");