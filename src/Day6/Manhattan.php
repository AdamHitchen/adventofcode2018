<?php declare(strict_types=1);

namespace Hitch\Day6;

use Hitch\ProblemSolverInterface;

class Manhattan implements ProblemSolverInterface
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

    private function getSmallestPoint(array $points): Point
    {
        $smallestPoint = new Point(PHP_INT_MAX, PHP_INT_MAX);
        foreach ($points as $point) {
            $smallestPoint->x = $point->x < $smallestPoint->x ? $point->x : $smallestPoint->x;
            $smallestPoint->y = $point->y < $smallestPoint->y ? $point->y : $smallestPoint->y;
        }
        return $smallestPoint;
    }

    private function getLargestPoint(array $points): Point
    {
        $largestPoint = new Point(PHP_INT_MIN, PHP_INT_MIN);
        foreach ($points as $point) {
            $largestPoint->x = $point->x > $largestPoint->x ? $point->x : $largestPoint->x;
            $largestPoint->y = $point->y > $largestPoint->y ? $point->y : $largestPoint->y;
        }
        return $largestPoint;
    }

    private function getClosestPoint(Point $location, array $points): ?Point
    {
        $closestPoint = null;
        $distance = PHP_INT_MAX;

        foreach ($points as $point) {
            $manDistance = $this->getManhattanDistance($point, $location);

            if ($this->getManhattanDistance($point, $location) < $distance) {
                $closestPoint = $point;
                $distance = $manDistance;
            }
        }

        return $closestPoint;
    }

    private function disqualifyPoints(
        array $points,
        array $map,
        Point $smallestPoint,
        Point $largestPoint,
        int $maxDistance
    ): array {
        $validPoints = [];
        /** @var Point $point */
        foreach ($points as $point) {
            //this point is on the boundary, meaning it must hit infinity
            if ($point->x == $smallestPoint->x
                || $point->y == $smallestPoint->y
                || $point->x == $largestPoint->x
                || $point->y == $largestPoint->y) {
                continue;
            }

            $directions = [
                [0, -1], // N
                [0, 1], // S
                [-1, 0], // W
                [1, 0], // E
                [-1, -1], // NW
                [1, -1], // NE
                [-1, 1], // SW
                [1, 1] // SE
            ];

            foreach ($directions as $direction) {
                for ($i = 0; $i < $maxDistance; $i++) {
                    $xPos = $point->x + ($i * $direction[0]);
                    $yPos = $point->y + ($i * $direction[1]);


                    //Nobody owns this Location. It must be invalid.
                    if (!isset($map[$xPos][$yPos])) {
                        continue 3;
                    }

                    /** @var Point $location */
                    $location = $map[$xPos][$yPos];

                    if ($location->x === $point->x && $location->y === $point->y) {
                        //This Point owns the location. Continue to next location
                        continue 1;
                    }
                    //Another point owns this location. Try a different direction
                    continue 2;
                }
                //If we didn't find a location owned by another point, disqualify this point
                continue 2;
            }


            $validPoints[] = $point;
        }

        return $validPoints;
    }

    public function solve(): string
    {
        $points = $this->prepareInput();
        $smallestPoint = $this->getSmallestPoint($points);
        $largestPoint = $this->getLargestPoint($points);
        $map = [];

        $maxDistance = 0;
        for ($i = $smallestPoint->x; $i <= $largestPoint->x; $i++) {
            $map[$i] = [];

            for ($j = $smallestPoint->y; $j <= $largestPoint->y; $j++) {
                $location = new Point($i, $j);
                $closest = $this->getClosestPoint($location, $points);

                $closest->coordinates[] = $location;
                $map[$i][$j] = $closest;

                $manHat = $this->getManhattanDistance($location, $closest);
                $maxDistance = max($manHat, $maxDistance);
            }
        }

        $validPoints = $this->disqualifyPoints($points, $map, $smallestPoint, $largestPoint, $maxDistance);
        $max = 0;

        /** @var Point $validPoint */
        foreach ($validPoints as $validPoint) {
            $max = count($validPoint->coordinates) > $max ? count($validPoint->coordinates) : $max;
        }

        return (string)$max;
    }
}