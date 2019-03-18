<?php
declare(strict_types=1);

namespace Kata\Converter;

class RomanConverter
{
    private $deciamlBaseNumber;
    private $romanDecimalMap;

    public function __construct()
    {
        $this->deciamlBaseNumber = [ 10, 5, 1 ];
        $this->romanDecimalMap = array(
            1 => "I",
            5 => "V",
            10 => "X"
        );
    }

    public function convertFromDecimal($decimal): string
    {
        $result = "";
        foreach ($this->deciamlBaseNumber as $i => $eachBase)
        {
            $decrease = $this->getDecrease($eachBase, $i);
            $decreaseNumber = $eachBase - $decrease;
            while ($decimal >= $decreaseNumber)
            {
                if ($decimal < $eachBase)
                {
                    $decimal -= $decreaseNumber;
                    $result .= $this->romanDecimalMap[$decrease];
                }
                else
                {
                    $decimal -= $eachBase;
                }
                $result .= $this->romanDecimalMap[$eachBase];
            }
        }
        return $result;
    }

    private function getDecrease($baseDecimal, $decimalIndex): int
    {
        $decreaseNumber = $baseDecimal >= 5 ? $this->deciamlBaseNumber[$decimalIndex + 1] : 0;
        if ($decreaseNumber == 5)
        {
            $decreaseNumber = $this->deciamlBaseNumber[$decimalIndex + 2];
        }
        return $decreaseNumber;
    } 
}
?>