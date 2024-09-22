<?php
declare(strict_types=1);

namespace block_quadratic_calculator;

defined('MOODLE_INTERNAL') || die();

class calculator {
    public static function solve(float $a, float $b, float $c)
    {
        $discriminant = $b * $b - 4 * $a * $c;

        if ($discriminant < 0) {
            throw new \Exception('Нет решении!');
        }

        $x1 = (-$b + sqrt($discriminant)) / (2 * $a);
        $x2 = (-$b - sqrt($discriminant)) / (2 * $a);

        return [$discriminant, $x1, $x2];
    }

}