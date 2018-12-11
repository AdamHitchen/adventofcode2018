<?php

namespace Tests\Day7;

use Hitch\Day7\WorkerInstructions;

class WorkerInstructionsTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = [
            'Step C must be finished before step A can begin.',
            'Step C must be finished before step F can begin.',
            'Step A must be finished before step B can begin.',
            'Step A must be finished before step D can begin.',
            'Step B must be finished before step E can begin.',
            'Step D must be finished before step E can begin.',
            'Step F must be finished before step E can begin.',
        ];

        $day6 = new WorkerInstructions($input, 1, 2);

        $this->assertEquals("15", $day6->solve());

    }

}