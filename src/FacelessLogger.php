<?php

namespace FacelessLog;

use FacelessLog\Anonymizers\AnonymizerInterface;
use FacelessLog\Anonymizers\EmailAnonymizer;
use FacelessLog\Detectors\DetectorInterface;
use FacelessLog\Detectors\EmailDetector;

class FacelessLogger
{
    private $detectors = [];
    private $anonymizers = [];

    public function __construct()
    {
        $this->addDetector(new EmailDetector());
        $this->addAnonymizer(new EmailAnonymizer());
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
