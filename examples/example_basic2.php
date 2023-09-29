<?php

require_once "vendor/autoload.php";

use FacelessLog\FacelessLogger;

$start_time = microtime(true);

$logger = new FacelessLogger();

$messages = [
    "The user's email is john.doe@example.com.",
    "Call me at +1 123-456-7890 or 1234567890.",
    "My credit card is 1234-5678-9012-3456.",
    "I was born on 15/03/1995."
];

foreach ($messages as $message) {
    echo "Original:   " . $message . "\n";
    echo "Anonymized: " . $logger->processMessage($message) . "\n";
    echo "---------------------------------------\n";
}
echo "Memory Used at this point " . memory_get_usage() . "\n";  
$end_time = microtime(true);

$execution_time = ($end_time - $start_time) * 1000;
echo "Peak Memory Used: " . (memory_get_peak_usage(true) / 1024) . " KB\n";
echo "Execution Time: " . $execution_time . " ms\n";
