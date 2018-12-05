<?php declare(strict_types=1);

namespace Tests\Day3;

use Hitch\Day3\FabricOverlapper;

class FabricOverlapperTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = [
            '#1 @ 1,3: 4x4',
            '#2 @ 3,1 4x4',
            '#3 @ 5,5: 2x2',
        ];

        $day3 = new FabricOverlapper($input);

        $this->assertEquals("4", $day3->solve());

    }

}