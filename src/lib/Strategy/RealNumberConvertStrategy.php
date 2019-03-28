<?php
declare(strict_types = 1);

namespace Kata\Strategy;

class RealNumberConvertStrategy implements NumberConvertStrategyInterface {

    private const FIZZ = "Fizz";
    private const BUZZ = "Buzz";


    public function convert(int $number) : string {
        $result = $this->convertFizz($number);
        $result .= $this->convertBuzz($number);

        if (empty($result)) {
            return \strval($number);
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