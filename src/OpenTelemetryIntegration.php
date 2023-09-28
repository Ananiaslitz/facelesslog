<?php

namespace FacelessLog;

use OpenTelemetry\API\Trace\Span;

class OpenTelemetryIntegration
{
    private $logger;

    public function __construct(FacelessLogger $logger)
    {
        $this->logger = $logger;
    }

    public function processSpan(Span $span)
    {
        $message = $span->getMessage();
        $anonymizedMessage = $this->logger->processMessage($message);
        $span->setMessage($anonymizedMessage);
    }

    public function processLogRecord(LogRecord $logRecord)
    {
        $message = $logRecord->getMessage();
        $anonymizedMessage = $this->logger->processMessage($message);
        $logRecord->setMessage($anonymizedMessage);
    }
}
