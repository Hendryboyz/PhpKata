<?php
declare (strict_types = 1);

use PHPUnit\Framework\TestCase;
use Kata\Converter\RomanConverter;

class RomanConverterTests extends TestCase {
    private $converter;

    public function testCanCreate(): void {
        $this->converter = new RomanConverter();
        $this->assertNotNull($this->converter);
    }

    public function setUp(): void {
        $this->testCanCreate();
    }

    public function testCanConvertFromDecimal(): void {
        $this->convertFromDecimalAndAssert(1, "I");
    }

    private function convertFromDecimalAndAssert(int $decimal, string $expected): void {
        $roman = $this->converter->convertFromDecimal($decimal);
        $this->assertEquals($expected, $roman);
    }

    /**
     * @dataProvider lessThan10Case
     */
    public function testGivenNumberLessThan10_WhenConvertFromDecimal_ThenReturnRoman(int $decimal, string $expected): void {
        $this->convertFromDecimalAndAssert($decimal, $expected);
    }

    public function lessThan10Case(): array {
        return array(
            array(2, "II"),
            array(3, "III"),
            array(5, "V"),
            array(10, "X"),
            array(6, "VI"),
            array(4, "IV"),
            array(9, "IX")
        );
    }

    /**
     * @dataProvider romanBaseDeciaml
     */
    public function testGivenRomanBaseDecimal_WhenConvertFromDecimal_ThenReturnRoman(int $decimal, string $expected): void {
        $this->convertFromDecimalAndAssert($decimal, $expected);
    }

    public function romanBaseDeciaml(): array {
        return array(
            array(50, "L"),
            array(100, "C"),
            array(500, "D"),
            array(1000, "M")
        );
    }
}

