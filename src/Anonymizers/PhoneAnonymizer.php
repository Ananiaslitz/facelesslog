<?php

namespace FacelessLog\Anonymizers;

class PhoneAnonymizer implements AnonymizerInterface
{
    public function anonymize(string $message): string
    {
        return preg_replace(
            '/(\+?\d{1,4}[-.\s]?\(?\d{1,4}\)?[-.\s]?\d{1,4}[-.\s]?)\d{4}/',
            '$1XXXX',
            $message
        );
    }
}
