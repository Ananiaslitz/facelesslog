<?php

namespace Unit\Anonymizers;

use PHPUnit\Framework\TestCase;
use FacelessLog\Anonymizers\EmailAnonymizer;

class EmailAnonymizerTest extends TestCase
{
    private $anonymizer;

    protected function setUp(): void
    {
        $this->anonymizer = new EmailAnonymizer();
    }

    public function testAnonymizeEmailAddress()
    {
        $originalMessage = "Contact me at john.doe@example.com.";
        $expectedMessage = "Contact me at j***.d**@example.com.";
        $this->assertEquals($expectedMessage, $this->anonymizer->anonymize($originalMessage));
    }

    public function testAnonymizeMultipleEmailAddresses()
    {
        $originalMessage = "Emails: alice@example.com and bob@example.com.";
        $expectedMessage = "Emails: a****@example.com and b**@example.com.";
        $this->assertEquals($expectedMessage, $this->anonymizer->anonymize($originalMessage));
    }

    public function testAnonymizeWithoutEmailAddress()
    {
        $originalMessage = "This message does not contain an email address.";
        $this->assertEquals($originalMessage, $this->anonymizer->anonymize($originalMessage));
    }
}
