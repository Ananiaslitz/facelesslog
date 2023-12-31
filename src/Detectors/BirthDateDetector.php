<?php

namespace FacelessLog\Detectors;

    class BirthDateDetector implements DetectorInterface
    {
        public function detect(string $message): bool
        {
            $patternBR = "/\b\d{2}\/\d{2}\/\d{4}\b/";
            $patternISO = "/\b\d{4}-\d{2}-\d{2}\b/";

            return preg_match($patternBR, $message) || preg_match($patternISO, $message);
        }
    }
