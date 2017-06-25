<?php

namespace Trial\Test\Functional;

use Trial\Core\InMemoryDatabase;
use Trial\Core\Kernel;
use Trial\Core\Request;
use Trial\Model\Score;

class GetTest {

    public function testGetTop100()
    {
        $scores = $this->setUp();
        $filename = 'tests';
        $kernel = new Kernel($filename);

        $request = new Request('GET', '/scores', ["from" => 1, "to" => 100]);
        $response = $kernel->run($request);

        $maxScore = max($scores);
        $result = $response->getBody();

        unlink(__DIR__ . '/../' . sprintf(InMemoryDatabase::DATABASE_FILE, $filename));

        if ($maxScore != $result[0]['score']) {
            return false;
        }

        if (count($result) < 100) {
            return false;
        }

        for ($i = 0; $i < 99; $i++) {
            if ($result[$i]['score'] < $result[$i+1]['score']) {
                return false;
            }
        }
    }

    private function setUp()
    {
        $scores = [];
        for ($i = 1; $i <= 500; $i++) {
            $scores[$i] = rand(10, 600);
        }
        $database = fopen(__DIR__ . '/../../tests.json', 'w');
        fwrite($database, json_encode($scores));

        return $scores;
    }

}