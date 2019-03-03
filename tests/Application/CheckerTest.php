<?php

namespace App\Test\Application;

use App\Application\Caller;
use App\Application\CardGenerator;
use PHPUnit\Framework\TestCase;

class CheckerTest extends TestCase
{
    public function testWinnerPlayer()
    {
        $cardGenerator = new CardGenerator();
        $card = $cardGenerator->generate();

        $caller = new Caller();
        for ($i = 0; $i < 75; $i++) {
            $caller->draw();
        }

        $winner = true;
        foreach ($card as $column => $number) {
            if (is_numeric($number) && !in_array($number, $caller->getDrawnNumbers())) {
                $winner = false;
            }
        }

        $this->assertTrue($winner);
    }
}
