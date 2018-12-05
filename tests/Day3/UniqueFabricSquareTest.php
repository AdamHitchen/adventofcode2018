<?php declare(strict_types=1);

namespace Tests\Day3;

use Hitch\Day3\UniqueFabricSquare;

class UniqueFabricSquareTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = [
            '#1 @ 1,3: 4x4',
            '#2 @ 3,1 4x4',
            '#3 @ 5,5: 2x2',
        ];

        $day3 = new UniqueFabricSquare($input);

        $this->assertEquals("3", $day3->solve());

    }

}