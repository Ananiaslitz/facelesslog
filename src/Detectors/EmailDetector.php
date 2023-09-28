<?php

namespace FacelessLog\Detectors;

class EmailDetector implements DetectorInterface
{
    public function detect(string $message): bool
    {
        $emailPattern = '/\b[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}\b/';
        return preg_match($emailPattern, $message) > 0;
    }
}
