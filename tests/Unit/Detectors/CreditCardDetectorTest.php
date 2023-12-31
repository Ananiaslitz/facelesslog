<?php

namespace Unit\Detectors;

use PHPUnit\Framework\TestCase;
use FacelessLog\Detectors\CreditCardDetector;

class CreditCardDetectorTest extends TestCase
{
    private $detector;

    protected function setUp(): void
    {
        $this->detector = new CreditCardDetector();
    }

    /**
     * @dataProvider creditCardMessageProvider
     */
    public function testDetectsCreditCard(string $message, bool $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->detector->detect($message));
    }

    public static function creditCardMessageProvider()
    {
        return [
            ["Credit card number is 1234-5678-9012-3456", true],
            ["Another card: 1234567890123456", true],
            ["Card with spaces: 1234 5678 9012 3456", true],
            ["Card with dots: 1234.5678.9012.3456", true],

            ["No card number here", false],
            ["Random numbers: 1234-5678", false],
            ["Incomplete card number: 1234-5678-9012", false],
        ];
    }
}