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

        //get current date and store in a variable orgDate
        $orgDate = date('m/d/Y h:i:s a', time());

        $rows = [];

        //initialise variables with the current period information
        //to store under each column of the array

        //loop through 12 periods, adding a record(row) for each month to the array
        $date = new \DateTime($orgDate);
        //initialise to this month, last day
        $date->modify('last day of this month');
        $date->format('Y-m-d');

        //loop through remaining 11 periods
        for ($rowIndex = 0; $rowIndex < 12; $rowIndex++)
        {
            $periodDate = $date->format('M/y');
            $basicPayDate = $date->format('Y-m-d');
            $bonusPayDate = $date->format("Y-m-10");

            //calculate basic salary date
            if(date('N', strtotime($basicPayDate)) == 6)
            {
                //Last day of month is Saturday
                //adjust last day of the month to be last working day, i.e. Friday (1 day before Saturday)
                $date->modify('-1 day');
            }
            elseif(date('N', strtotime($basicPayDate)) == 7)
            {
                //Last day of month is Sunday
                //adjust last day of the month to be last working day, i.e. Friday (2 days before Sunday)
                $date->modify('-2 day');
            }
            else
            {
                //Last day of month is weekday :. no adjustment to last working day
            }
            $basicPayDate = $date->format('Y-m-d');

            //calculate bonus pay date
            if(date('N', strtotime($bonusPayDate)) == 6)
            {
                //10th day of month is Saturday
                //adjust bonus day of the month to be Monday 12th (i.e. 2 days after Saturday 10th of the month)
                $bonusPayDate = $date->format('Y-m-12');
            }
            elseif(date('N', strtotime($bonusPayDate)) == 7)
            {
                //Last day of month is Sunday
                //adjust bonus day of the month to be Monday 11th (i.e. 1 day after Sunday 10th of the month)
                $bonusPayDate = $date->format('Y-m-11');
            }
            else
            {
                //Bonus day being the 10th of the month is a weekday :. no adjustment to bonus payment day
                $bonusPayDate = $date->format('Y-m-10');
            }

            $rows[$rowIndex] = [$periodDate, $basicPayDate, $bonusPayDate];
            //increment 1 month to the date object using '1' parameter, and adjust date object to the last day
            $date->modify('last day of 1 month');
        }
        
        $table->setHeaderTitle('Salary')
            ->setHeaders(['Period', 'Basic Payment', 'Bonus Payment']);
        $table->setRows($rows);

        $table->render();

        //write to CSV
        //open a stream for output
        $fp = fopen('file.csv', 'w');

        //write headers to CSV
        fputcsv($fp, ['Period', 'Basic Payment', 'Bonus Payment']);
        //loop through the records of dates and write rows to CSV
        foreach ($rows as $fields) {
            fputcsv($fp, $fields);
        }

        //close the stream
        fclose($fp);

        //not abstract so have to return int, expected 0, not null.
        return 0;
    }   
}