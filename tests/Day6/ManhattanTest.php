<?php declare(strict_types=1);

namespace Tests\Day6;

use Hitch\Day6\Manhattan;

class ManhattanTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = [
            '1, 1',
            '1, 6',
            '8, 3',
            '3, 4',
            '5, 5',
            '8, 9',
        ];

        $day6 = new Manhattan($input);

        $this->assertEquals("17", $day6->solve());

    }

}