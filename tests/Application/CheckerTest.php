<?php

namespace App\Test\Application;

use App\Application\BingoGame;
use App\Utility\NumberUtilities;
use PHPUnit\Framework\TestCase;

class CheckerTest extends TestCase
{
    /** @var BingoGame */
    private $bingoGame;

    protected function setUp()
    {
        $this->bingoGame = new BingoGame();

        parent::setUp();
    }

    public function testWinningPlayer()
    {
        $playerCard = $this->bingoGame->generateCard();
        $drawnNumbers = $playerCard->getNumbers();

        $this->assertTrue($this->bingoGame->isWinningCard($playerCard, $drawnNumbers));
    }

    public function testNoWinningPlayer()
    {
        $playerCard = $this->bingoGame->generateCard();
        $drawnNumbers = $playerCard->getNumbers();

        $playerCardArray = $playerCard->toArray();
        $drawnNumbers[0] = NumberUtilities::randomUniqueNumber(1, 15, $playerCardArray['B']);

        $this->assertFalse($this->bingoGame->isWinningCard($playerCard, $drawnNumbers));
    }
}
