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
    private static FacelessLogger $instance;
    private $detectors = [];
    private $anonymizers = [];

    public function __construct()
    {
        $this->addDetector(new EmailDetector(), new EmailAnonymizer());
        $this->addDetector(new PhoneDetector(), new PhoneAnonymizer());
        $this->addDetector(new CreditCardDetector(), new CreditCardAnonymizer());
        $this->addDetector(new BirthDateDetector(), new BirthDateAnonymizer());
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new FacelessLogger();
        }
        return self::$instance;
    }


    public function addDetector(DetectorInterface $detector, AnonymizerInterface $anonymizer)
    {
        $this->detectors[get_class($detector)] = $detector;
        $this->anonymizers[get_class($detector)] = $anonymizer;
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
        foreach ($this->detectors as $detectorClass => $detector) {
            if ($detector->detect($message)) {
                $anonymizer = $this->anonymizers[$detectorClass];
                $message = $anonymizer->anonymize($message);
            }
        }
        return $message;
    }
}
