<?php

namespace Trial\Core;

class Request
{

    private $method;
    private $path;
    private $params = [];

    /**
     * Request constructor.
     * @param $method
     * @param $path
     * @param $body
     */
    public function __construct($method, $path, $body)
    {
        $this->method = $method;
        $parts = $this->extractPath($path);
        $this->path = $parts[0];
        $this->loadQuery($parts);
        $this->loadBody($body);
    }

    public function get($key, $default = null) {
        if (isset($this->params[$key]) && !is_null($this->params[$key])) {
            return $this->params[$key];
        }

        return $default;
    }

    private function basicSanitize($requestParam)
    {
        return htmlspecialchars(strip_tags($requestParam));
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    private function loadBody($body)
    {
        if (!empty($body)) {
            foreach ($body as $key => $param) {
                $this->params[$key] = $this->basicSanitize($param);
            }
        }
    }

    /**
     * @param $path
     * @return array
     */
    private function extractPath($path)
    {
        return explode("?", $path);
    }

    /**
     * @param $parts
     */
    private function loadQuery($parts)
    {
        if (!empty($parts[1])) {
            $queryStrings = explode("&", $parts[1]);
            foreach ($queryStrings as $queryString) {
                list ($key, $value) = explode("=", $queryString);
                $this->params[$key] = $value;
            }
        }
    }

}
