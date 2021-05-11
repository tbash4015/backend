<?php

class WorkingDay extends DateTime
{
    protected string $datetime;
    protected DateTimeZone $timezone;
    private string $workingDayStringVal;

    public function lastDayIsAWorkingDay()
    {   
        //use today - now, as the initial value. To be replaced with function parameter
        $todaydate = new \DateTime(date('m/d/Y h:i:s a', time()));
        //initialise to this month, last day
        $workingDayStringVal = $todaydate->modify('last day of this month');
            
        if(date('N', strtotime($workingDayStringVal)) <= 6)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}