<?php

namespace App\Test;

use App\CardGenerator;
use PHPUnit\Framework\TestCase;

class CardGeneratorTest extends TestCase
{
    public function testColumnBShouldContainNumbersLessOrEqualThan15()
    {
        $cardGenerator = new CardGenerator();

        $card = $cardGenerator->generate();

        for ($i = 1; $i <= 5; $i++) {
            $this->assertLessThanOrEqual(15, $card['B'][$i]);
        }
    }

    public function testColumnBShouldContainUniqueNumbers()
    {
        $cardGenerator = new CardGenerator();
        $card = $cardGenerator->generate();

        foreach ($card['B'] as $key => $value) {
            $column = $card['B'];
            unset($column[$key]);
            $this->assertNotContains($value, $column);
        }
    }

    public function testColumnIShouldContainNumbersGreaterOrEqualThan16AndLessOrEqualThan30()
    {
        $cardGenerator = new CardGenerator();
        $card = $cardGenerator->generate();

        for ($i = 1; $i <= 5; $i++) {
            $this->assertGreaterThanOrEqual(16, $card['I'][$i]);
            $this->assertLessThanOrEqual(30, $card['I'][$i]);
        }
    }

    public function testColumnIShouldContainUniqueNumbers()
    {
        $cardGenerator = new CardGenerator();
        $card = $cardGenerator->generate();

        foreach ($card['I'] as $key => $value) {
            $column = $card['I'];
            unset($column[$key]);
            $this->assertNotContains($value, $column);
        }
    }

    public function testColumnNShouldContainNumbersGreaterOrEqualThan31AndLessOrEqualThan45()
    {
        $cardGenerator = new CardGenerator();
        $card = $cardGenerator->generate();

        for ($i = 1; $i <= 5; $i++) {
            $this->assertGreaterThanOrEqual(31, $card['N'][$i]);
            $this->assertLessThanOrEqual(45, $card['N'][$i]);
        }
    }
}
