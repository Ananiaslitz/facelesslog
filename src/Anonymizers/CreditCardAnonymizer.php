<?php

namespace FacelessLog\Anonymizers;

class CreditCardAnonymizer implements AnonymizerInterface
{
    public function anonymize(string $message): string
    {
        return preg_replace(
            '/(\d{4})[-.\s]?\d{4}[-.\s]?\d{4}[-.\s]?\d{4}/',
            '$1-XXXX-XXXX-XXXX',
            $message
        );
    }
}
