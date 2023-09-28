<?php

require_once "vendor/autoload.php";

use FacelessLog\FacelessLogger;

$logger = new FacelessLogger();

$message = "O usuario com o email johndoe@example.com tentou logar.";

echo $logger->processMessage($message) . PHP_EOL;
