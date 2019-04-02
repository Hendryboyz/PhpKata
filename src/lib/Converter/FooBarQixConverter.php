<?php 
declare(strict_types = 1);

namespace Kata\Converter;

class FooBarQixConverter {

    public const FOO = "Foo";
    public const BAR = "Bar";
    public const QIX = "Qix";
    public const STAR_SIGN = "*";

    public function __construct() {
        
    }


    public function convert(int $number) : string {
        $result = $this->convertByDivisor($number);
        $result .= $this->convertByDigitElement($number);
        if (!empty($result)) {
            return $result;
        }
        else {
            return \strval($number);
        }
    }


    private function convertByDivisor(int $number) : string {
        $result = "";
        if ($this->isNumberDivisible($number, 3)) {
            $result .= self::FOO;
        }
        if ($this->isNumberDivisible($number, 5)) {
            $result .= self::BAR;
        }
        if ($this->isNumberDivisible($number, 7)) {
            $result .= self::QIX;
        }
        return $result;
    }

    
    private function isNumberDivisible(int $number, int $divisor) : bool {
        return 0 == ($number % $divisor);
    }


    private function convertByDigitElement($number) : string {
        $result = "";
        foreach ($this->toDigitArray($number) as $eachDigit) {
            switch($eachDigit) {
                case '3' : 
                    $result .= self::FOO;
                    break;
                case '5' : 
                    $result .= self::BAR;
                    break;
                case '7' : 
                    $result .= self::QIX;
                    break;
                // case '0' : 
                //     $result .= self::STAR_SIGN;
                //     break;
                default : 
                    break;
            }
        }
        return $result;
    }


    private function toDigitArray(int $number) : array {
        return str_split(\strval($number));
    }
}

?>