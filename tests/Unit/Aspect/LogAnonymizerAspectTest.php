<?php

namespace Unit\Aspect;

use PHPUnit\Framework\TestCase;
use FacelessLog\Aspect\LogAnonymizerAspect;
use FacelessLog\FacelessLogger;
use Hyperf\Di\Aop\ProceedingJoinPoint;

class LogAnonymizerAspectTest extends TestCase
{
    private $logger;
    private $aspect;

    protected function setUp(): void
    {
        $this->logger = $this->createMock(FacelessLogger::class);
        $this->aspect = new LogAnonymizerAspect($this->logger);
    }

    public function testProcess()
    {
        $originalMessage = "Sensitive data: 1234-5678-9012-3456";
        $anonymizedMessage = "Anonymized data";

        $this->logger
            ->expects($this->once())
            ->method('processMessage')
            ->with($originalMessage)
            ->willReturn($anonymizedMessage);

        $proceedingJoinPoint = $this->createMock(ProceedingJoinPoint::class);
        $proceedingJoinPoint
            ->expects($this->once())
            ->method('getArguments')
            ->willReturn([$originalMessage]);

        $proceedingJoinPoint
            ->expects($this->once())
            ->method('process')
            ->with([$anonymizedMessage])
            ->willReturn('Some return value');

        $result = $this->aspect->process($proceedingJoinPoint);

        $this->assertEquals('Some return value', $result);
    }
}
