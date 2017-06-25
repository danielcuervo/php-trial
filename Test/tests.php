<?php

require __DIR__ . '/../autoload.php';

$testCollection = [
    new \Trial\Test\Functional\AbsoluteTest(),
    new \Trial\Test\Functional\RelativeTest(),
    new \Trial\Test\Functional\GetTest(),
    new \Trial\Test\Unit\Repository\InMemoryStoreRepositoryTest(),
    new \Trial\Test\Unit\Validator\CollectionTest(),
    new \Trial\Test\Unit\Validator\GreaterThanTest(),
    new \Trial\Test\Unit\Validator\IsNumericTest(),
    new \Trial\Test\Unit\Domain\Scoring\SaveAbsoluteScoreTest(),
    new \Trial\Test\Unit\Domain\Scoring\SaveRelativeScoreTest(),
];

$failedScenarios = [];
$success = 0;
foreach ($testCollection as $testClass) {
    $methods = get_class_methods($testClass);
    foreach ($methods as $method) {
        if (substr($method, 0, 4) === 'test') {
            $result = $testClass->$method();
            if ($result !== false) {
                print '.';
                $success++;
            } else {
                print 'F';
                $failedScenarios[] = get_class($testClass) . "->$method has failed.\n";
            }
        }
    }
}
print "\nSucceeded: $success Failed: ". count($failedScenarios) . "\n";
if (count($failedScenarios) > 0) {

    print "Scenarios that failed:\n";
    foreach ($failedScenarios as $failedScenario) {
        print $failedScenario;
    }
}