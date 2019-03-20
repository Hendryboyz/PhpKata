<?php

declare (strict_types = 1);

namespace Kata\Converter;

class RomanConverter {

    private $baseDecimals;
    private $decimalRomanMap;

    public function __construct() {
        $this->baseDecimals = [1000, 500, 100, 50, 10, 5, 1];
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

    public function convertFromDecimal(int $decimal): string {
        $roman = "";
        foreach ($this->baseDecimals as $index => $eachBase) {
            $decrease = $this->getDecrease($index);
            $decreaseNumber = $eachBase - $decrease;
            while ($decreaseNumber <= $decimal) {
                if ($decimal < $eachBase) {
                    $roman .= $this->decimalRomanMap[$decrease];
                    $decimal -= $decreaseNumber;
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
        $decrease = count($this->baseDecimals) == $baseIndex + 1 ?
            0 : $this->baseDecimals[$baseIndex + 1];
        if (!$this->isValidDecrease($decrease)) {
            $decrease = $this->baseDecimals[$baseIndex + 2];
        }
        return $decrease;
    }

    private function isValidDecrease(int $decrease): bool {
        return 5 != $decrease && 500 != $decrease && 50 != $decrease;
    }
}
?>