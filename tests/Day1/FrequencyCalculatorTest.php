<?php declare(strict_types=1);

namespace Tests\Day1;

use Hitch\Day1\FrequencyCalculator;

class FrequencyCalculatorTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = [
            1,
            1,
            1
        ];

        $day1 = new FrequencyCalculator($input, 0);

        $this->assertEquals("3", $day1->solve());

    }

    /** @test */
    public function solution_matches_provided_examples_2()
    {
        $input = [
            1,
            1,
            -2
        ];

        $day1 = new FrequencyCalculator($input, 0);

        $this->assertEquals("0", $day1->solve());
    }

    /** @test */
    public function solution_matches_provided_examples_3()
    {
        $input = [
            -1,
            -2,
            -3
        ];

        $day1 = new FrequencyCalculator($input, 0);

        $this->assertEquals("-6", $day1->solve());
    }

}