<?php
require '../vendor/autoload.php';

use Ming\DataBuilder;

ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

$plays = [
    "hamlet" => [
        'name' => 'Hamlet',
        'type' => 'tragedy'
    ],
    'as-like' => [
        'name' => 'As You Like It',
        'type' => 'comedy'
    ],
    'othello' => [
        'name' => 'Othello',
        'type' => 'tragedy'
    ]
];

$invoice = [
    'customer' => 'Ming',
    'performances' => [
        [
            'playID' => 'hamlet',
            'audience' => 55
        ],
        [
            'playID' => 'as-like',
            'audience' => 35
        ],
        [
            'playID' => 'othello',
            'audience' => 40
        ],
    ]
];



function statement($invoice, $plays)
{   
    $builder = new DataBuilder($plays);
    $statementData = $builder->createStatementData($invoice, $plays);
    
    return renderPlainText($statementData, $plays);
}



function renderPlainText($data)
{
    $result = "Statement for {$data['customer']}  ";

    foreach ($data['performances'] as $perf) {
        $result .= $perf['play']['name'] . ':' . $perf['amount'] . "  " . $perf['audience'] . 'seats ';
    }

    $result .= "Amount owed is $" . $data['totalAmount'] . "  ";
    $result .= "You earned " . $data['totalVolumeCredits'] . " credits ";

    return $result;
}

$result = statement($invoice, $plays);
dd($result);
