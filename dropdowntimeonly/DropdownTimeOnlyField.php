<?php

/**
 *@author nicolaas [at] sunnysideup . co . nz
 *
 *
 *
 **/

class DropdownTimeOnlyField extends DropdownField
{
    protected $timeFormat = "H:i";

    protected $intervalsPerHour = 4;

    public function __construct($name, $title = null, $timeFormat = "", $value = "", $form = null, $emptyString = null)
    {
        $source = $this->buildSource();
        $this->source = $source;
        if ($timeFormat) {
            $this->$timeFormat = $timeFormat;
        }
        parent::__construct($name, $title, $source, $value, $form, $emptyString);
    }

    public function setIntervalsPerHour(Int $intervalsPerHour)
    {
        $this->$intervalsPerHour = $number;
    }

    protected function buildSource()
    {
        $source = array();
        $minutesToAdd = round(60/$this->intervalsPerHour);
        for ($h = 0; $h < 25; $h++) {
            for ($i = 0; $i < 60; $i = $i + $minutesToAdd) {
                $hString = strval($h);
                $iString = strval($i);
                $fullString = str_pad($h, 2, "0", STR_PAD_LEFT).":".str_pad($i, 2, "0", STR_PAD_LEFT);
                $value = Date($this->timeFormat, strtotime($fullString));
                $source[$value] = $value;
            }
        }
        return $source;
    }
}
