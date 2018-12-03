<?php declare(strict_types=1);

namespace Hitch\Day3;

use Hitch\ProblemSolverInterface;

final class UniqueFabricSquare implements ProblemSolverInterface
{

    /**
     * @var array
     */
    private $input;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    private function getClaimFromString($string): Claim
    {
        $claim = new Claim();
        $values = explode(' ', $string);
        // remove the @
        unset($values[1]);
        $claim->id = (int)str_replace("#", "", $values[0]);
        $position = explode(',', str_replace(":", "", $values[2]));
        $claim->x = (int)$position[0];
        $claim->y = (int)$position[1];

        $size = explode('x', $values[3]);
        $claim->width = (int)$size[0];
        $claim->height = (int)$size[1];

        return $claim;
    }

    public function solve(): string
    {
        $fabric = [];

        $uniqueClaims=[];

        foreach($this->input as $value) {
            $claim = $this->getClaimFromString($value);

            for($i = $claim->x; $i < $claim->x + $claim->width; $i++) {
                for($j = $claim->y; $j < $claim->y + $claim->height; $j++){
                    if(isset($fabric[$i][$j])) {
                        $claim->excluded = true;

                        unset($uniqueClaims[$fabric[$i][$j]->id]);
                    }

                    $fabric[$i][$j] = $claim;
                }
            }

            if(!$claim->excluded) {
                $uniqueClaims[$claim->id]=$claim;
            }
        }

        return (string) array_pop($uniqueClaims)->id;
    }

}