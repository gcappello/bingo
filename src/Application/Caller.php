<?php

namespace App\Application;

use App\Utility\NumberUtilities;

class Caller
{
    private $pile = [];

    public function draw()
    {
        $number = NumberUtilities::randomUniqueNumber(1, 75, $this->pile);
        $this->pile[] = $number;

        return $number;
    }

    public function getDrawnNumbers()
    {
        return $this->pile;
    }
}
