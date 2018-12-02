<?php declare(strict_types=1);

use Hitch\Day1\FrequencyCalculator;
use Hitch\Day1\FrequencyCalibrator;

include 'vendor/autoload.php';

//This file will get split out later

$inputFile = file_get_contents('./input/Day1/input.txt');
$input = array_map('intval', array_filter(explode("\n", $inputFile)));

$solver = new FrequencyCalculator($input, 0);
echo("Day 1, part 1: " . $solver->solve() . "\n");

$solver = new FrequencyCalibrator($input, 0);
echo("Day 2, part 2: " . $solver->solve() . "\n");