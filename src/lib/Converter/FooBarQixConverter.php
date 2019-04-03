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
        $this->appendByDigit($number, $result);
        
        return $result;
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


    private function appendByDigit (int $number, string &$result) : void {
        foreach (\str_split(\strval($number)) as $eachDigit) {
            switch ($eachDigit) {
            case '3' : 
                $result .= self::FOO;
                break;
            case '5' : 
                $result .= self::BAR;
                break;
            case '7' : 
                $result .= self::QIX;
                break;
            case '0' :
                $result .= self::STAR_SIGN;
                break;
            default :
                if ($number % 3 != 0 && $number % 5 != 0 && $number % 7 != 0 ) {
                    $result .= $eachDigit;
                }
                break;
            }
        }
    }
}
?>