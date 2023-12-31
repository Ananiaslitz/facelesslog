<?php

namespace Unit\Detectors;

use PHPUnit\Framework\TestCase;
use FacelessLog\Detectors\EmailDetector;

class EmailDetectorTest extends TestCase
{
    private $detector;

    protected function setUp(): void
    {
        $this->detector = new EmailDetector();
    }

    /**
     * @dataProvider emailMessageProvider
     */
    public function testDetectsEmail(string $message, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->detector->detect($message));
    }

    public static function emailMessageProvider()
    {
        return [
            ["Contact me at john.doe@example.com", true],
            ["Email: jane_doe123@subdomain.example.co.uk", true],

            ["This is a plain text without email.", false],
            ["Just a website www.example.com, no email here.", false],
        ];
    }
}
