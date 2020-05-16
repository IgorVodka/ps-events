<?php

namespace App\Util;

class BladeUtil
{
    public function pluralize(int $n, array $endings): string
    {
        $cases = [2, 0, 1, 1, 1, 2];
        return sprintf($endings[($n % 100 > 4 && $n % 100 < 20) ? 2 : $cases[min($n % 10, 5)]], $n);
    }
}
