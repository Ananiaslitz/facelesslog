<?php

namespace Unit\Detectors;

use PHPUnit\Framework\TestCase;
use FacelessLog\Detectors\BirthDateDetector;

class BirthDateDetectorTest extends TestCase
{
    private $detector;

    protected function setUp(): void
    {
        $this->detector = new BirthDateDetector();
    }

    /**
     * @dataProvider dateMessageProvider
     */
    public function testDetectsDate(string $message, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->detector->detect($message));
    }

    public static function dateMessageProvider()
    {
        return [
            "with pt-br date" => ["A data de nascimento é 01/01/1990.", true],
            "with iso date" => ["The birth date is 1990-01-01.", true],

            "without date" => ["Este texto não tem uma data.", false],
            "without iso date" => ["This text doesn't have a date.", false],
        ];
    }
}
