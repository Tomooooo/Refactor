<?php

namespace Ming;

use Exception;

class PerformanceCalculator
{
    protected $aPerformance;
    protected $play;

    public function __construct($aPerformance, $play)
    {
        $this->aPerformance = $aPerformance;
        $this->play = $play;
    }


    public function getPlay()
    {
        return $this->play;
    }

    public function getAmount()
    {
        throw new \Exception('你怎么找到爷爷这来了');
    }

    public function getVolumeCredits()
    {
        return max($this->aPerformance['audience'] - 30, 0);
    }
}
