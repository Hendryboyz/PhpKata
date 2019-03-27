<?php
declare(strict_types=1);

namespace Kata\Converter;

class FizzBuzzConverter {

    public const FIZZ = "Fizz";
    public const BUZZ = "Buzz";

    private $convertStrategy;

    public function __construct() { }


    public function setConvertStrategy($convertStrategy): void {
        $this->convertStrategy = $convertStrategy;
    }


    public function convert(int $number): string {
        if (isset($this->convertStrategy)) {
            $result = $this->convertStrategy->convert($number);
        }
        else {
            $result = $this->doConvert($number);
        }

        if (empty($result)) {
            return \strval($number);
        }
        else {
            return $result;
        }
    }


    private function doConvert(int $number): string {
        $result = $this->convertFizz($number);
        $result .= $this->convertBuzz($number);
        return $result;
    }
    

    private function convertFizz(int $number): string {
        if (0 == ($number % 3)) {
            return  self::FIZZ;
        }
        else {
            return "";
        }
    }


    private function convertBuzz(int $number): string {
        if (0 == ($number % 5)) {
            return  self::BUZZ;
        }
        else {
            return "";
        }
    }
}
?>