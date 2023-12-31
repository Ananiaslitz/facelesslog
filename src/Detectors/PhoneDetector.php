<?php

namespace FacelessLog\Detectors;

class PhoneDetector implements DetectorInterface
{
    public function detect(string $message): bool
    {
        return preg_match('/\+?\d{1,4}[-.\s]?\(?\d{2,4}\)?[-.\s]?\d{3,4}[-.\s]?\d{4,6}/', $message);
    }
}