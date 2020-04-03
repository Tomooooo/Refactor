<?php

namespace Ming;

class ComedyCalculator extends PerformanceCalculator
{
    public function getAmount()
    {
        $result = 30000;
        if ($this->aPerformance['audience'] > 20) {
            $result += 100000 + 500 * ($this->aPerformance['audience'] - 20);
        }
        $result += 300 * $this->aPerformance['audience'];

        return $result;
    }

    function getVolumeCredits()
    {
        return parent::getVolumeCredits() + floor($this->aPerformance['audience'] / 5);
    }
}
