<?php

namespace Trial\Core;

use Trial\Exception\ClientErrorInterface;
use Trial\Exception\Validator\ValidationFailedException;

class Kernel
{
    const maxWait = 6000;

    public function __construct($databaseFilename = null)
    {
        $this->databaseFilename = $databaseFilename;
    }

    public function run(Request $request) {
        $waitTime = 0;
        while (file_exists(__DIR__ . InMemoryDatabase::LOCK_FILE)) {
            if ($waitTime >= self::maxWait) {
                return new Response(500, ["error" => "Server timeout"]);
            }
            usleep(300);
            $waitTime += 300;
        }

        $database = new InMemoryDatabase($this->databaseFilename);
        $database->lock();
        $router = new Router();
        try {
            $response = $router->route($request, $database);
        } catch (ClientErrorInterface $e) {
            $error = 404;
            if ($e instanceof ValidationFailedException) {
                $error = 400;
            }
            $response =  new Response($error, ["error" => $e->getMessage()]);
        } catch (\Exception $e) {
            $response =  new Response("500", ["error" => $e->getMessage()]);
        }

        $database->unlock();

        return $response;
    }

}
