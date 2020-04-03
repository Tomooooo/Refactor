<?php

namespace Ming;

class DataBuilder
{   
    protected $plays;

    public function __construct($plays)
    {
        $this->plays = $plays;
    }

    public function createStatementData($invoice)
    {
        $statementData = [];
        $statementData['customer'] = $invoice['customer'];

        $statementData['performances'] = $invoice['performances'];
        foreach ($statementData['performances'] as &$performance) {
            $play = $this->playFor($performance, $this->plays);
            switch($play['type']) {
                case "tragedy":
                    $calculator = new TragedyCalculator($performance, $this->playFor($performance, $this->plays));
                break;
                case "comedy":
                    $calculator = new ComedyCalculator($performance, $this->playFor($performance, $this->plays));
                break;
            }
            $performance['play'] = $calculator->getPlay();
            $performance['amount'] = $calculator->getAmount();
            $performance['volumeCredits'] = $calculator->getVolumeCredits();
        }   

        $statementData['totalAmount'] = $this->totalAmount($statementData['performances']);
        $statementData['totalVolumeCredits'] = $this->totalVolumeCredits($statementData['performances']);

        return $statementData;
    }

    function totalVolumeCredits($performances)
    {
        $result = 0;
        foreach ($performances as $perf) {
            $result += $perf['volumeCredits'];
        }

        return $result;
    }

    function totalAmount($performances)
    {
        $result = 0;
        foreach ($performances as $perf) {
            $result += $perf['amount'];
        }

        return $result;
    }




    public function playFor($aPerformance)
    {
        return $this->plays[$aPerformance['playID']];
    }

    
}
