<?php

declare(strict_types=1);

namespace Kata\Strategy;

use Kata\Strategy\NumberConvertStrategyInterface;

abstract class NumberConverterDecorator implements NumberConvertStrategyInterface {
    
    protected $numberConvertStrategy;


    public function __construct(NumberConvertStrategyInterface $numberConvertStrategy)
    {
        $this->numberConvertStrategy = $numberConvertStrategy;
    }


    abstract public function convert(int $number) : string;
}
?>