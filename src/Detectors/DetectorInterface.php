<?php

namespace FacelessLog\Detectors;

interface DetectorInterface
{
    public function detect(string $message): bool;
}
