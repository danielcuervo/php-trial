<?php

namespace Trial\Test\Functional;

use Trial\Core\InMemoryDatabase;
use Trial\Core\Kernel;
use Trial\Core\Request;

class RelativeTest {

    public function testRelativeScore()
    {
        $filename = 'tests';
        $kernel = new Kernel($filename);

        $expected = [];
        for ($i = 1; $i < 10; $i++) {
            $expected[$i] = rand(10, 100) . "";

            $request = new Request('POST', '/scores/relative', ["user" => $i, "score" => $expected[$i]]);
            $kernel->run($request);
        }

        for ($i = 1; $i < 10; $i++) {
            $extra = rand(10, 100);
            $expected[$i] += $extra;

            $request = new Request('POST', '/scores/relative', ["user" => $i, "score" => $extra]);
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