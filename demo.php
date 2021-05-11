#!/usr/bin/env php

<?php

require __DIR__.'/vendor/autoload.php';

use Backend\Command\SalaryCommand;
use Symfony\Component\Console\Application;

$app = new Application();

$app->add(new SalaryCommand());

$app->run();