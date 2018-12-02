<?php declare(strict_types=1);

namespace Tests\Day1;

use Hitch\Day2\StringDiff;

class StringDiffTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = [
            'abcde',
            'fghij',
            'klmno',
            'pqrst',
            'fguij',
            'axcye',
            'wvxyz'
        ];

        $day2 = new StringDiff($input);

        $this->assertEquals("fgij", $day2->solve());

    }


}