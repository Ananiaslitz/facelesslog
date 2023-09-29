<?php

namespace FacelessLog;

use FacelessLog\Anonymizers\AnonymizerInterface;
use FacelessLog\Anonymizers\BirthDateAnonymizer;
use FacelessLog\Anonymizers\CreditCardAnonymizer;
use FacelessLog\Anonymizers\EmailAnonymizer;
use FacelessLog\Anonymizers\PhoneAnonymizer;
use FacelessLog\Detectors\BirthDateDetector;
use FacelessLog\Detectors\CreditCardDetector;
use FacelessLog\Detectors\DetectorInterface;
use FacelessLog\Detectors\EmailDetector;
use FacelessLog\Detectors\PhoneDetector;

class FacelessLogger
{
    private $detectors = [];
    private $anonymizers = [];

    public function __construct()
    {
        $this->addDetector(new EmailDetector());
        $this->addAnonymizer(new EmailAnonymizer());

        $this->addDetector(new PhoneDetector());
        $this->addAnonymizer(new PhoneAnonymizer());

        $this->addDetector(new CreditCardDetector());
        $this->addAnonymizer(new CreditCardAnonymizer());

        $this->addDetector(new BirthDateDetector());
        $this->addAnonymizer(new BirthDateAnonymizer());
    }

    public function addDetector(DetectorInterface $detector)
    {
        $this->detectors[] = $detector;
    }

    public function addAnonymizer(AnonymizerInterface $anonymizer)
    {
        $this->anonymizers[] = $anonymizer;
    }

    public function clearDefaultDetectors()
    {
        $this->detectors = [];
    }

    public function clearDefaultAnonymizers()
    {
        $this->anonymizers = [];
    }

    public function processMessage($message)
    {
        foreach ($this->detectors as $detector) {
            if ($detector->detect($message)) {
                foreach ($this->anonymizers as $anonymizer) {
                    $message = $anonymizer->anonymize($message);
                }
            }
        }
        return $message;
    }
}
