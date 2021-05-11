<?php

namespace Backend\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class MessageCommand extends Command
{
    protected function configure()
    {
        $this->setName('msg')
            ->setDescription('Prints a user provided message')
            ->setHelp('This command prints a message provided by the user')
            ->addArgument('msg', InputArgument::REQUIRED, 'Pass a message');
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = sprintf('The message is: %s', $input->getArgument('msg'));
        $output->writeln($message);
        return 0;
    }
}