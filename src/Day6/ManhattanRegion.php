<?php declare(strict_types=1);

namespace Hitch\Day6;

use Hitch\ProblemSolverInterface;

class ManhattanRegion implements ProblemSolverInterface
{
    /**
     * @var string
     */
    private $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    private function prepareInput()
    {
        $coordinates = [];
        foreach ($this->input as $item) {
            $coordinates[] = Point::fromArray(explode(",", str_replace(" ", "", $item)));
        }

        return $coordinates;
    }

    private function getManhattanDistance(Point $pointA, Point $pointB): int
    {
        return abs($pointA->y - $pointB->y) + abs($pointA->x - $pointB->x);
    }

    private function getCentralPoint(array $points): Point
    {
        $xTotal = 0;
        $yTotal = 0;

        foreach($points as $point) {
            $xTotal += $point->x;
            $yTotal += $point->y;
        }

        $x = $xTotal / count($points);
        $y = $yTotal / count($points);

        return new Point((int) floor($x), (int) floor($y));
    }

    public function solve(): string
    {
        $points = $this->prepareInput();

        $maxDistanceBetweenPoints = $this->getMaxDistanceBetweenPoints($points);
        $maxDistance = 10000;
        $optim = (int) floor((($maxDistance - $maxDistanceBetweenPoints) / count($points)));
        $cPoint = $this->getCentralPoint($points);

        $smallestPoint = new Point($cPoint->x - $optim, $cPoint->y - $optim);
        $largestPoint = new Point( $cPoint->x + $optim, $cPoint->y + $optim);

        $count = 0;
        $wastedCount = 0;
        for ($i = $smallestPoint->x; $i <= $largestPoint->x; $i++) {
            for ($j = $smallestPoint->y; $j <= $largestPoint->y; $j++) {
                $total = 0;
                $location = new Point($i, $j);
                foreach($points as $point) {
                    $total +=$this->getManhattanDistance($point, $location);

                    if($total >= $maxDistance)
                    {
                        $wastedCount++;
                        continue 2;
                    }
                }
                $count++;
            }
        }
        return (string)$count . " : " . $wastedCount;
    }

    /**
     * @param array $points
     * @return array
     */
    private function getMaxDistanceBetweenPoints(array $points): int
    {
        $maxDistanceBetweenPoints = 0;

        foreach ($points as $key => $point) {
            for ($i = $key + 1; $i < count($points); $i++) {
                $mdist = $this->getManhattanDistance($point, $points[$i]);
                $maxDistanceBetweenPoints = max($maxDistanceBetweenPoints, $mdist);
            }
        }
        return $maxDistanceBetweenPoints;
    }
}