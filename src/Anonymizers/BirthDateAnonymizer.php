<?php

namespace FacelessLog\Anonymizers;

class BirthDateAnonymizer implements AnonymizerInterface
{
    public function anonymize(string $message): string
    {
        $message = preg_replace("/\b\d{2}\/\d{2}\/\d{4}\b/", "XX/XX/XXXX", $message);
        return preg_replace("/\b\d{4}-\d{2}-\d{2}\b/", "XXXX-XX-XX", $message);

    }
}
