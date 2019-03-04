<?php

namespace App\Application;

use App\Domain\Model\CardDto;

class BingoGame
{
    /** @var CardGenerator */
    private $cardGenerator;

    /** @var Caller */
    private $caller;

    public function __construct()
    {
        $this->cardGenerator = new CardGenerator();
        $this->caller = new Caller();
    }

    public function generateCard(): CardDto
    {
        return $this->cardGenerator->generate();
    }

    public function isWinningCard(CardDto $card, array $drawnNumbers = []): bool
    {
        if (empty($drawnNumbers)) {
            $drawnNumbers = $this->caller->getDrawnNumbers();
        }

        $isWinner = true;
        foreach ($card->toArray() as $column) {
            foreach ($column as $row => $number) {
                if (is_numeric($number) && !in_array($number, $drawnNumbers)) {
                    $isWinner = false;
                }
            }
        }
        return $isWinner;
    }
}
