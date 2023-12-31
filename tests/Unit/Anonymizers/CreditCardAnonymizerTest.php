<?php

namespace Unit\Anonymizers;

use PHPUnit\Framework\TestCase;
use FacelessLog\Anonymizers\CreditCardAnonymizer;

class CreditCardAnonymizerTest extends TestCase
{
    private $anonymizer;

    protected function setUp(): void
    {
        $this->anonymizer = new CreditCardAnonymizer();
    }

    public function testAnonymizeCreditCardNumber()
    {
        $originalMessage = "The credit card number is 1234-5678-9012-3456.";
        $expectedMessage = "The credit card number is 1234-XXXX-XXXX-XXXX.";
        $this->assertEquals($expectedMessage, $this->anonymizer->anonymize($originalMessage));
    }

    public function testAnonymizeWithDifferentSeparators()
    {
        $originalMessage = "Cards: 1234 5678 9012 3456, 1234.5678.9012.3456.";
        $expectedMessage = "Cards: 1234-XXXX-XXXX-XXXX, 1234-XXXX-XXXX-XXXX.";
        $this->assertEquals($expectedMessage, $this->anonymizer->anonymize($originalMessage));
    }

    public function testAnonymizeWithoutCreditCardNumber()
    {
        $originalMessage = "This message does not contain a credit card number.";
        $this->assertEquals($originalMessage, $this->anonymizer->anonymize($originalMessage));
    }
}