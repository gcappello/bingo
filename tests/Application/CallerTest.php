<?php

namespace App\Test\Application;

use App\Application\Caller;
use PHPUnit\Framework\TestCase;

class CallerTest extends TestCase
{
    public function testCalledNumberGreaterThan1AndLessOrEqualThan75()
    {
        $caller = new Caller();

        $number = $caller->draw();

        $this->assertGreaterThanOrEqual(1, $number);
        $this->assertLessThanOrEqual(75, $number);
    }

    public function testAllTheNumbersShouldHaveBeenCalled()
    {
        $caller = new Caller();
        $numbers = [];

        for ($i = 0; $i < 75; $i++) {
            array_push($numbers, $caller->draw());
        }

        sort($numbers);

        $allPresent = true;

        for ($i = 0; $i < 75; $i++) {
            if ($numbers[$i] != $i+1) {
                $allPresent = false;
                break;
            }
        }
        
        $this->assertTrue($allPresent);
    }
}
