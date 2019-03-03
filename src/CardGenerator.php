<?php

namespace App;

class CardGenerator
{
    private $columns;

    private $rows;

    private $maxNumber;

    private $freeSpaces;

    public const FREE = 'FREE';

    public function __construct($columns, $rows, int $maxNumber, array $freeSpaces)
    {
        $this->columns = $columns;
        $this->rows = $rows;
        $this->maxNumber = $maxNumber;
        $this->freeSpaces = $freeSpaces;
    }

    public function generate(): array
    {
        $card = [];

        $range = $this->maxNumber / count($this->columns);

        foreach ($this->columns as $row => $column) {
            $lowerBound = ($row + 1) * $range - ($range - 1);
            $upperBound = ($row + 1) * $range;

            for ($i = 1; $i <= $this->rows; $i++) {
                $excludedNumbers = !empty($card[$column]) ? array_values($card[$column]) : [];

                $card[$column][$i] = $this->randomUniqueNumber(
                    $lowerBound,
                    $upperBound,
                    $excludedNumbers
                );
            }
        }

        $card[$this->freeSpaces['column']][$this->freeSpaces['row']] = self::FREE;

        return $card;
    }

    private function randomUniqueNumber($lowerBound, $upperBound, $excludedNumbers): int
    {
        do {
            $number = random_int($lowerBound, $upperBound);
        } while (in_array($number, $excludedNumbers));

        return $number;
    }
}
