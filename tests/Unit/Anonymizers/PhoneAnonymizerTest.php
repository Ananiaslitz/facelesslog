<?php

namespace Unit\Anonymizers;

use PHPUnit\Framework\TestCase;
use FacelessLog\Anonymizers\PhoneAnonymizer;

class PhoneAnonymizerTest extends TestCase
{
    private $anonymizer;

    protected function setUp(): void
    {
        $this->anonymizer = new PhoneAnonymizer();
    }

    public function testAnonymizePhoneNumber()
    {
        $originalMessage = "Contact number is +123 4567 8901.";
        $expectedMessage = "Contact number is +123 4567 XXXX.";
        $this->assertEquals($expectedMessage, $this->anonymizer->anonymize($originalMessage));
    }

    public function testAnonymizeMultiplePhoneNumbers()
    {
        $originalMessage = "Numbers are (123) 456-7890 and 123.456.7890.";
        $expectedMessage = "Numbers are (123) 456-XXXX and 123.456.XXXX.";
        $this->assertEquals($expectedMessage, $this->anonymizer->anonymize($originalMessage));
    }

    public function testAnonymizeWithoutPhoneNumber()
    {
        $originalMessage = "This message does not contain a phone number.";
        $this->assertEquals($originalMessage, $this->anonymizer->anonymize($originalMessage));
    }
}
