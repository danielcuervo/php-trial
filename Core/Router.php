<?php

namespace Trial\Core;

use Trial\Exception\Routing\PathNotFoundException;
use Trial\Exception\Routing\MethodNotFoundException;

class Router
{

    private $paths = [
        "GET" => [
            "/scores" => [
                "controller" => "Trial\\Controller\\ScoreController",
                "function" => "get"
            ],
        ],
        "POST" => [
            "/scores/absolute" => [
                "controller" => "Trial\\Controller\\ScoreController",
                "function" => "saveAbsolute"
            ],
            "/scores/relative" => [
                "controller" => "Trial\\Controller\\ScoreController",
                "function" => "saveRelative"
            ],
        ],
    ];

    public function route(Request $request, InMemoryDatabase $database)
    {
        if (empty($this->paths[$request->getMethod()])) {
            throw new MethodNotFoundException();
        }

        if (empty($this->paths[$request->getMethod()][$request->getPath()])) {
            throw new PathNotFoundException();
        }

        $controller = $this->paths[$request->getMethod()][$request->getPath()]["controller"];
        $function = $this->paths[$request->getMethod()][$request->getPath()]["function"];

        $controller = new $controller($database);
        return $controller->$function($request);
    }

}
