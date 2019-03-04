<?php

namespace App\Domain\Dto;

class CardDto
{
    /** @var array */
    private $spaces = [];

    public function __construct(array $spaces)
    {
        $this->spaces = $spaces;
    }

    public function toArray(): array
    {
        return $this->spaces;
    }

    public function getNumbers(): array
    {
        $numbers = [];

        foreach ($this->spaces as $column) {
            foreach ($column as $row => $number) {
                if (is_numeric($number)) {
                    $numbers[] = $number;
                }
            }
        }

        return $numbers;
    }
}
