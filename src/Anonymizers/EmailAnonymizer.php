<?php

namespace FacelessLog\Anonymizers;

class EmailAnonymizer implements AnonymizerInterface
{
    public function anonymize(string $message): string
    {
        return preg_replace_callback('/\b([A-Za-z0-9._%+-]+)@([A-Za-z0-9.-]+\.[A-Z|a-z]{2,})\b/', function ($matches) {
            $localPart = $matches[1];
            $domain = $matches[2];

            $parts = explode('.', $localPart);
            $anonymizedParts = array_map(function ($part) {
                return $part[0] . str_repeat('*', strlen($part) - 1);
            }, $parts);

            $anonymizedLocalPart = implode('.', $anonymizedParts);

            return $anonymizedLocalPart . '@' . $domain;
        }, $message);
    }
}
