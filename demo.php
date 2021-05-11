#!/usr/bin/env php

<?php

require __DIR__.'/vendor/autoload.php';

use Backend\Command\SalaryCommand;
use Backend\Command\BooksCommand;
use Backend\Command\MessageCommand;
use Backend\Command\AskNameCommand;
use Backend\Command\TimeCommand;
use Symfony\Component\Console\Application;

$app = new Application();

$app->add(new SalaryCommand());
$app->add(new BooksCommand());
$app->add(new MessageCommand());
$app->add(new AskNameCommand());
$app->add(new TimeCommand());

$app->run();