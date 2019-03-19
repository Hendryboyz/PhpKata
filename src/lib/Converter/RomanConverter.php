<?php
declare (strict_types = 1);

namespace Kata\Converter;

class RomanConverter {
    private $baseDecimal;
    private $decimalRomanMap;

    public function __construct() {
        $this->baseDecimal = [1000, 500, 100, 50, 10, 5, 1];
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
        $result = "";
        foreach($this->baseDecimal as $index => $eachBase) {
            $decrease = $this->getDecrease($index);
            $decreaseNumber = $eachBase - $decrease;

            while ($decreaseNumber <= $decimal) {
                if ($decimal < $eachBase) {
                    $result .= $this->decimalRomanMap[$decrease];
                    $decimal -= $decreaseNumber;
                }
                else {
                    $decimal -= $eachBase;
                }
                $result .= $this->decimalRomanMap[$eachBase];
            }
        }
        return $result;
    }

    private function getDecrease(int $baseIndex): int {
        $decrease = $this->isLastBaseDecimal($baseIndex) ? 0 : $this->baseDecimal[$baseIndex + 1];
        if (!$this->isValidDecrease($decrease)) {
            $decrease = $this->baseDecimal[$baseIndex + 2];
        }
        return $decrease;
    }

    private function isLastBaseDecimal(int $baseIndex): bool {
        return ($baseIndex == count($this->baseDecimal) - 1);
    }

    private function isValidDecrease(int $decrease): bool {
        return $decrease != 5 && $decrease != 50 && $decrease != 500;
    }
}

?>