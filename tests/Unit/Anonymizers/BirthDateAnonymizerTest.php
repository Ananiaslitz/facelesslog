<?php

namespace Unit\Anonymizers;

use PHPUnit\Framework\TestCase;
use FacelessLog\Anonymizers\BirthDateAnonymizer;

class BirthDateAnonymizerTest extends TestCase
{
    private $anonymizer;

    protected function setUp(): void
    {
        $this->anonymizer = new BirthDateAnonymizer();
    }

    public function testAnonymizeWithDashedDateFormat()
    {
        $originalMessage = "User's birth date is 1990-01-01.";
        $expectedMessage = "User's birth date is XXXX-XX-XX.";
        $this->assertEquals($expectedMessage, $this->anonymizer->anonymize($originalMessage));
    }

    public function testAnonymizeWithSlashedDateFormat()
    {
        $originalMessage = "User's birth date is 01/01/1990.";
        $expectedMessage = "User's birth date is XX/XX/XXXX.";
        $this->assertEquals($expectedMessage, $this->anonymizer->anonymize($originalMessage));
    }

    public function testAnonymizeWithoutDate()
    {
        $originalMessage = "No date in this message.";
        $this->assertEquals($originalMessage, $this->anonymizer->anonymize($originalMessage));
    }
}
