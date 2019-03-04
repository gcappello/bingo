<?php

namespace App\Application;

use App\Utility\NumberUtilities;

class CardGenerator
{
    private $columns;

    private $rows;

    private $maxNumber;

    private $freeSpaces;

    public const FREE = 'FREE';

    private $card;

    public function __construct(
        $columns = ['B','I','N','G','O'],
        $rows = 5,
        int $maxNumber = 75,
        array $freeSpaces = ['column' => 'N', 'row' => 3]
    ) {
        $this->columns = $columns;
        $this->rows = $rows;
        $this->maxNumber = $maxNumber;
        $this->freeSpaces = $freeSpaces;
    }

    public function generate(): array
    {
        $this->card = [];

        $range = $this->maxNumber / count($this->columns);

        foreach ($this->columns as $row => $column) {
            $lowerBound = ($row + 1) * $range - ($range - 1);
            $upperBound = ($row + 1) * $range;

            for ($i = 1; $i <= $this->rows; $i++) {
                $excludedNumbers = !empty($this->card[$column]) ? array_values($this->card[$column]) : [];

                $this->card[$column][$i] = NumberUtilities::randomUniqueNumber(
                    $lowerBound,
                    $upperBound,
                    $excludedNumbers
                );
            }
        }

        $this->card[$this->freeSpaces['column']][$this->freeSpaces['row']] = self::FREE;

        return $this->card;
    }

    public function getCardNumbers(): array
    {
        $drawnNumbers = [];

        foreach ($this->card as $column) {
            foreach ($column as $row => $number) {
                if (is_numeric($number)) {
                    $drawnNumbers[] = $number;
                }
            }
        }

        return $drawnNumbers;
    }
}
