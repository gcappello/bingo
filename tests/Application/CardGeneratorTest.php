<?php

namespace App\Test\Application;

use App\Application\CardGenerator;
use PHPUnit\Framework\TestCase;

class CardGeneratorTest extends TestCase
{
    private $card;

    public function setUp()
    {
        $cardGenerator = new CardGenerator();

        $this->card = $cardGenerator->generate();

        parent::setUp();
    }

    public function testColumnBShouldContainNumbersLessOrEqualThan15()
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->assertLessThanOrEqual(15, $this->card['B'][$i]);
        }
    }

    public function testColumnIShouldContainNumbersGreaterOrEqualThan16AndLessOrEqualThan30()
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->assertGreaterThanOrEqual(16, $this->card['I'][$i]);
            $this->assertLessThanOrEqual(30, $this->card['I'][$i]);
        }
    }

    public function testColumnsShouldContainUniqueNumbers()
    {
        foreach ($this->card['B'] as $key => $value) {
            $column = $this->card['B'];
            unset($column[$key]);
            $this->assertNotContains($value, $column);
        }

        foreach ($this->card['I'] as $key => $value) {
            $column = $this->card['I'];
            unset($column[$key]);
            $this->assertNotContains($value, $column);
        }
    }

    public function testShouldHaveOneFreeSpaceInTheMiddle()
    {
        $this->assertIsNotNumeric($this->card['N'][3]);
    }
}
