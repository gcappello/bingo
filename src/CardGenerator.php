<?php

namespace App;

class CardGenerator
{
    private $columns =  [
        'B',
        'I',
        'N',
        'G',
        'O'
    ];

    private $maxNumber = 75;

    public function __construct()
    {
    }

    public function generate()
    {
        $card = [];

        $range = $this->maxNumber / count($this->columns);

        foreach ($this->columns as $index => $column) {
            $lowerBound = ($index + 1) * $range - ($range - 1);
            $upperBound = ($index + 1) * $range;

            for ($i = 1; $i <= 5; $i++) {
                $excludedNumbers = [];

                if (!empty($card[$column])) {
                    $excludedNumbers = array_values($card[$column]);
                }

                $card[$column][$i] = $this->randomUniqueNumber(
                    $lowerBound,
                    $upperBound,
                    $excludedNumbers
                );
            }
        }


        return $card;
    }

    private function randomUniqueNumber($lowerBound, $upperBound, $excludedNumbers)
    {
        do {
            $number = random_int($lowerBound, $upperBound);
        } while (in_array($number, $excludedNumbers));

        return $number;
    }
}
