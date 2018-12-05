<?php declare(strict_types=1);

namespace Tests\Day4;

use Hitch\Day4\LongestSleepingGuard;
use Hitch\Day4\SleepingGuard;

class SleepingGuardTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function solution_matches_provided_examples()
    {
        $input = [
            '[1518-11-01 00:00] Guard #10 begins shift',
            '[1518-11-01 00:05] falls asleep',
            '[1518-11-01 00:25] wakes up',
            '[1518-11-01 00:30] falls asleep',
            '[1518-11-01 00:55] wakes up',
            '[1518-11-01 23:58] Guard #99 begins shift',
            '[1518-11-02 00:40] falls asleep',
            '[1518-11-02 00:50] wakes up',
            '[1518-11-03 00:05] Guard #10 begins shift',
            '[1518-11-03 00:24] falls asleep',
            '[1518-11-03 00:29] wakes up',
            '[1518-11-04 00:02] Guard #99 begins shift',
            '[1518-11-04 00:36] falls asleep',
            '[1518-11-04 00:46] wakes up',
            '[1518-11-05 00:03] Guard #99 begins shift',
            '[1518-11-05 00:45] falls asleep',
            '[1518-11-05 00:55] wakes up',
        ];

        $day4 = new SleepingGuard($input);

        $this->assertEquals("240", $day4->solve());

    }

    /** @test */
    public function solution_matches_solution()
    {
        $inputFile = file_get_contents(__DIR__ . '/../../input/Day4/input.txt');
        $input = array_filter(explode("\n", $inputFile));
        $day4 = new SleepingGuard($input);
        $this->assertEquals("3212",$day4->solve());

    }
}