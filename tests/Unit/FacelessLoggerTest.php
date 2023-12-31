<?php

namespace Unit;

use PHPUnit\Framework\TestCase;
use FacelessLog\FacelessLogger;
use FacelessLog\Detectors\EmailDetector;
use FacelessLog\Anonymizers\EmailAnonymizer;

class FacelessLoggerTest extends TestCase
{
    private $logger;

    protected function setUp(): void
    {
        $this->logger = FacelessLogger::getInstance();
    }

    public function testSingletonInstance()
    {
        $logger1 = FacelessLogger::getInstance();
        $logger2 = FacelessLogger::getInstance();
        $this->assertSame($logger1, $logger2);
    }

    public function testAddAndProcessDetectorAnonymizer()
    {
        $email = "test@example.com";
        $anonymizedEmail = "t***@example.com";

        $this->logger->addDetector(new EmailDetector(), new EmailAnonymizer());
        $result = $this->logger->processMessage($email);

        $this->assertEquals($anonymizedEmail, $result);
    }

    public function testClearDefaultDetectors()
    {
        $this->logger->addDetector(new EmailDetector(), new EmailAnonymizer());

        $this->logger->clearDefaultDetectors();

        $detectors = $this->getPrivateProperty($this->logger, 'detectors');
        $this->assertEmpty($detectors);
    }

    public function testClearDefaultAnonymizers()
    {
        $this->logger->addDetector(new EmailDetector(), new EmailAnonymizer());

        $this->logger->clearDefaultAnonymizers();

        $anonymizers = $this->getPrivateProperty($this->logger, 'anonymizers');
        $this->assertEmpty($anonymizers);
    }

    public function testProcessMessageWithNoDetectors()
    {
        $this->logger->clearDefaultDetectors();

        $message = "test@example.com";
        $processedMessage = $this->logger->processMessage($message);

        $this->assertEquals($message, $processedMessage);
    }

    private function getPrivateProperty($object, $propertyName)
    {
        $reflector = new \ReflectionClass($object);
        $property = $reflector->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
