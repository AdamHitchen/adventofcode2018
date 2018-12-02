<?php declare(strict_types=1);

namespace Tests\Day1;

use Hitch\Day1\FrequencyCalibrator;

class Day1Test extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = [
            1,
            -1,
        ];

        $frequencyCalibrator = new FrequencyCalibrator($input, 0);

        $this->assertEquals("0", $frequencyCalibrator->solve());

    }

    /** @test */
    public function solution_matches_provided_examples_2()
    {
        $input = [
            3,
            3,
            4,
            -2,
            -4
        ];

        $frequencyCalibrator = new FrequencyCalibrator($input, 0);

        $this->assertEquals("10", $frequencyCalibrator->solve());
    }

    /** @test */
    public function solution_matches_provided_examples_3()
    {
        $input = [
            -6,
            3,
            8,
            5,
            -6
        ];

        $frequencyCalibrator = new FrequencyCalibrator($input, 0);

        $this->assertEquals("5", $frequencyCalibrator->solve());
    }

    /** @test */
    public function solution_matches_provided_examples_4()
    {
        $input = [
            7,
            7,
            -2,
            -7,
            -4
        ];

        $frequencyCalibrator = new FrequencyCalibrator($input, 0);

        $this->assertEquals("14", $frequencyCalibrator->solve());
    }
}