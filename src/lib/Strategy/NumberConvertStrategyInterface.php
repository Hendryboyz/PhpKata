<?php
declare(strict_types = 1);

namespace Kata\Strategy;

interface NumberConvertStrategyInterface {

    public function convert(int $number) : string;
    
}
?>