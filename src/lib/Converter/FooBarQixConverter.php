<?php
declare(strict_types = 1);

namespace Kata\Converter;

class FooBarQixConverter {

    public const FOO = "Foo";
    public const BAR = "Bar";
    public const QIX = "Qix";

    public function convert(int $number) {
        $result = $this->convertByDivisor($number);
        $result .= $this->convertByNumberDigit($number);
        
        if (!empty($result)) {
            return $result;
        }
        else {
            return \strval($number);
        }
    }


    private function convertByDivisor(int $number) : string {
        $result = "";
        if (0 == ($number % 3)) {
            $result .= self::FOO;
        }
        if (0 == ($number % 5)) {
            $result .= self::BAR;
        }
        if (0 == ($number % 7)) {
            $result .= self::QIX;
        }
        return $result;
    }

    private function convertByNumberDigit(int $number) : string {
        $result = "";
        foreach ($this->convertToDigitArray($number) as $eachNumberCharacter) {
            if ('3' == $eachNumberCharacter) {
                $result .= self::FOO;
            }
            if ('5' == $eachNumberCharacter) {
                $result .= self::BAR;
            }
            if ('7' == $eachNumberCharacter) {
                $result .= self::QIX;
            }
        }
        return $result;
    }

    private function convertToDigitArray(int $number) : array {
        return \str_split(\strval($number));
    }
}

?>