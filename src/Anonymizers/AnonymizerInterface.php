<?php

namespace FacelessLog\Anonymizers;

interface AnonymizerInterface
{
    public function anonymize(string $message): string;
}
