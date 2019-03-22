<?php 
declare (strict_types = 1);

namespace Kata\Converter;

class RomanConverter {

    private const baseDecimals = [ 1000, 500, 100, 50, 10, 5, 1 ];

    private $decimalRomanMap;

    public function __construct() {
        $this->decimalRomanMap = array(
            1 => "I",
            5 => "V",
            10 => "X",
            50 => "L",
            100 => "C",
            500 => "D",
            1000 => "M"
        );
    }


    public function convertFromDecimal(int $decimal) {
        if (0 == $decimal) {
            throw new \InvalidArgumentException();
        }
        $roman = "";
        foreach ( self::baseDecimals as $baseIndex => $eachBase ) {
            $decrease = $this->getDecrease($baseIndex);
            $decreaseNuumber = $eachBase - $decrease;
            while ( $decreaseNuumber <= $decimal ) {
                if ( $decimal < $eachBase ) {
                    $roman .= $this->decimalRomanMap[$decrease];
                    $decimal -= $decreaseNuumber;
                }
                else {
                    $decimal -= $eachBase;
                }
                $roman .= $this->decimalRomanMap[$eachBase];
            }
        }
        return $roman;
    }


    private function getDecrease(int $baseIndex): int {
        if ($this->isLastBaseDecimal($baseIndex)) {
            return 0;
        }
        $decrease = self::baseDecimals[$baseIndex + 1];
        if ( !$this->isValidDecrease($decrease) ) {
            $decrease = self::baseDecimals[$baseIndex + 2];
        }
        return $decrease;
    }


    private function isLastBaseDecimal(int $baseIndex): bool {
        return count(self::baseDecimals) - 1 == $baseIndex;
    }


    private function isValidDecrease(int $decrease): bool {
        return 500 != $decrease && 50 != $decrease && 5 != $decrease;
    }
}
?>