<?php

namespace Unit\Detectors;

use PHPUnit\Framework\TestCase;
use FacelessLog\Detectors\PhoneDetector;

class PhoneDetectorTest extends TestCase
{
    private $detector;

    protected function setUp(): void
    {
        $this->detector = new PhoneDetector();
    }

    /**
     * @dataProvider phoneMessageProvider
     */
    public function testDetectsPhone(string $message, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->detector->detect($message));
    }

    public static function phoneMessageProvider()
    {
        return [
            ["Call me at +123 4567 8901", true],
            ["Phone: (123) 456-7890", true],
            ["Mobile: 123.456.7890", true],
            ["Contact: 1234567890", true],

            ["No phone number here", false],
            ["Random numbers: 1234-5678", false],
        ];
    }
}