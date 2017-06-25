<?php

use Trial\Core\Kernel;
use Trial\Core\Request;

require __DIR__ . '/../autoload.php';


$request = new Request(
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI'],
    json_decode(file_get_contents('php://input'))
);

$kernel = new Kernel();
$response = $kernel->run($request);

http_response_code($response->getCode());
print json_encode($response->getBody());