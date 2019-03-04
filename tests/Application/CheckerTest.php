<?php

namespace App\Test\Application;

use App\Application\CardGenerator;
use App\Utility\NumberUtilities;
use PHPUnit\Framework\TestCase;

class CheckerTest extends TestCase
{
    private $cardGenerator;

    protected function setUp()
    {
        $this->cardGenerator = new CardGenerator();

        parent::setUp();
    }

    public function testWinningPlayer()
    {
        $card = $this->cardGenerator->generate();
        $drawnNumbers = $this->cardGenerator->getCardNumbers();

        $winner = true;
        foreach ($card as $column) {
            foreach ($column as $row => $number) {
                if (is_numeric($number) && !in_array($number, $drawnNumbers)) {
                    $winner = false;
                }
            }
        }

        $this->assertTrue($winner);
    }

    public function testNoWinningPlayer()
    {
        $card = $this->cardGenerator->generate();
        $drawnNumbers = $this->cardGenerator->getCardNumbers();

        $drawnNumbers[0] = NumberUtilities::randomUniqueNumber(1, 15, $card['B']);

        $winner = true;
        foreach ($card as $column) {
            foreach ($column as $row => $number) {
                if (is_numeric($number) && !in_array($number, $drawnNumbers)) {
                    $winner = false;
                }
            }
        }

        $this->assertFalse($winner);
    }
}
