<?php

namespace Backend\Command;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SalaryCommand extends Command
{
    protected function configure() 
    {
        $this->setName('salary')
            ->setDescription('Save CSV file with payment dates for the next 12 months')
            ->setHelp('This command demonstrates the output to CSV using a CLI based application');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $table = new Table($output);

        $orgDate = "2021-01-05";  
        $periodDate = date("M/y", strtotime($orgDate));
        $basicPayDate = date("Y-m-d", strtotime($orgDate));
        $bonusPayDate = date("Y-m-d", strtotime($orgDate));
        
        $table->setHeaderTitle('Salary')
            ->setHeaders(['Period', 'Basic Payment', 'Bonus Payment'])
            ->setRows([
                [$periodDate, $basicPayDate, $bonusPayDate],
                [$periodDate, $basicPayDate, $bonusPayDate],
                [$periodDate, $basicPayDate, $bonusPayDate]
            ]);

          $table->render();
          return 0;
    }   
}