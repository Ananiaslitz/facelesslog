<?php

namespace FacelessLog\Detectors;

class CreditCardDetector implements DetectorInterface
{
    public function detect(string $message): bool
    {
        return preg_match('/\d{4}[-.\s]?\d{4}[-.\s]?\d{4}[-.\s]?\d{4}/', $message);
    }
}
