<?php
declare(strict_types=1);

namespace Kata\Strategy;

class NumberConvertStrategy implements NumberConvertStrategyInterface {

    public function convert(int $number) : string {
        return \strval($number);
    }
    
}