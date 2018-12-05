<?php declare(strict_types=1);

namespace Tests\Day2;

use Hitch\Day2\Checksum;

class ChecksumTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = [
            'abcdef',
            'bababc',
            'abbcde',
            'abcccd',
            'aabcdd',
            'abcdee',
            'ababab'
        ];

        $day2 = new Checksum($input);

        $this->assertEquals("12", $day2->solve());

    }

}