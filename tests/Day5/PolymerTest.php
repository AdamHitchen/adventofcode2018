<?php declare(strict_types=1);

namespace Tests\Day5;

use Hitch\Day4\LongestSleepingGuard;
use Hitch\Day4\SleepingGuard;
use Hitch\Day5\Polymer;

class PolymerTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = 'dabAcCaCBAcCcaDA';

        $day4 = new Polymer($input);

        $this->assertEquals("10", $day4->solve());

    }

}