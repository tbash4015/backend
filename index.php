#!/usr/bin/env php
<?php
// index.php

require __DIR__.'/vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application('Salary record generator', 1.0);

// ... register commands

$application->run();
