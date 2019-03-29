<?php

declare(strict_types=1);

namespace Kata\Strategy;

class FizzBuzzNumberConverterDecorator extends NumberConverterDecorator {

    public const FIZZ = "Fizz";
    public const BUZZ = "Buzz";

    public function __construct(NumberConvertStrategyInterface $numberConvertStrategy)
    {
        parent::__construct($numberConvertStrategy);
    }


    public function convert(int $number) : string {
        $result = $this->convertFizz($number);
        $result .= $this->convertBuzz($number);
        if (empty($result)) {
            return $this->numberConvertStrategy->convert($number);
        }
        else {
            return $result;
        }
    }

    
    private function convertFizz(int $number) : string {
        if (0 == ($number % 3)) {
            return self::FIZZ;
        }
        else {
            return "";
        }
    }


    private function convertBuzz(int $number) : string {
        if (0 == ($number % 5)) {
            return self::BUZZ;
        }
        else {
            return "";
        }
    }
}
?>