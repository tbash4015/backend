<?php
// WorkingDayTest.php
include_once("WorkingDay.php");

class WorkingDayTest extends \PHPUnit\Framework\TestCase
{
    public function testLastDayIsAWorkingDay()
    {
        //test if 31st May (a Monday) is a working day i.e. 'N' value of date string value is less than 6 (Saturday)
        $this->assertLessThan(6, date('N', strtotime("2021-05-31")));
    }
}