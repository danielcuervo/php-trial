<?php

namespace Trial\Test\Functional;

use Trial\Core\InMemoryDatabase;
use Trial\Core\Kernel;
use Trial\Core\Request;

class AbsoluteTest {

    public function testAbsoluteScore()
    {
        $filename = 'tests';
        $database = sprintf(InMemoryDatabase::DATABASE_FILE, $filename);
        $kernel = new Kernel($filename);

        $expected = [];
        for ($i = 1; $i < 100; $i++) {
            $expected[$i] = rand(10, 100) . "";

            $request = new Request('POST', '/scores/absolute', ["user" => $i, "score" => $expected[$i]]);
            $kernel->run($request);
        }

        $database = new InMemoryDatabase($filename);
        $result = $database->load();

        unlink(__DIR__ . '/../' . sprintf(InMemoryDatabase::DATABASE_FILE, $filename));
        if ($result != $expected) {
            return false;
        }
    }
}