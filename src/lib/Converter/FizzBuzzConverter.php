<?php
declare (strict_types = 1);

namespace Kata\Converter;

class FizzBuzzConverter {

    const FIZZ = "Fizz";
    const BUZZ = "Buzz";

    public function __construct() {
        ;
    }

    public function convert(int $number): string {
        $result = $this->convertFizz($number);
        $result .= $this->convertBuzz($number);
        if (empty($result)) {
            $result .= $number;
        }
        return $result;
    }

    public function convertFizz(int $number): string {
        if (0 == ($number % 3)) {
            return self::FIZZ;
        }
        else {
            return "";
        }
    }

    public function convertBuzz(int $number): string {
        if (0 == ($number % 5)) {
            return self::BUZZ;
        }
        else {
            return "";
        }
    }
}
?>