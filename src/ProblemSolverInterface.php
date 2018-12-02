<?php declare(strict_types=1);

namespace Hitch;

interface ProblemSolverInterface
{
    public function solve(): string;
}