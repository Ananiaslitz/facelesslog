<?php

namespace FacelessLog\Aspect;

use Hyperf\Di\Aop\AbstractAspect;
use Hyperf\Di\Aop\ProceedingJoinPoint;
use FacelessLog\FacelessLogger;
use Hyperf\Di\Exception\Exception;

class LogAnonymizerAspect extends AbstractAspect
{

    /**
     * @var FacelessLogger
     */
    private FacelessLogger $logger;

    public function __construct(FacelessLogger $logger)
    {
        $this->logger = $logger;
    }

    public array $classes = [
        'Namespace\Da\Sua\Classe::*LogMethod',
    ];

    /**
     * @throws Exception
     */
    public function process(ProceedingJoinPoint $proceedingJoinPoint)
    {
        $arguments = $proceedingJoinPoint->getArguments();
        $arguments[0] = $this->logger->processMessage($arguments[0]);
        return $proceedingJoinPoint->process($arguments);
    }
}
