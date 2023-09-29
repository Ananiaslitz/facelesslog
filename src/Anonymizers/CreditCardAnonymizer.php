<?php

namespace FacelessLog\Anonymizers;

class CreditCardAnonymizer implements AnonymizerInterface
{
    public function anonymize(string $message): string
    {
        return preg_replace(
            '/(\d{4}[-.\s]?)\d{4}[-.\s]?\d{4}[-.\s]?/',
            '$1XXXX-XXXX-',
            $message
        );
    }
}
