<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Kata\Converter\RomanConverter;

class RomanConverterTests extends TestCase
{
    private $converter;

    public function testCanCreate(): void
    {
        $this->converter = new RomanConverter();
        $this->assertNotNull($this->converter);
    }

    public function setUp(): void
    {
        $this->testCanCreate();
    }

    public function testCanConvertFromDecimal(): void
    {
        $roman = $this->converter->convertFromDecimal(1);
        $this->assertEquals('I', $roman);
    }

    /**
     * @dataProvider lessEqualThan10Case
     */
    public function testGivenDecimalLessThan10_WhenConvertFromDecimal_ThemReturnRoman($decimal, $expected): void
    {
        $roman = $this->converter->convertFromDecimal($decimal);
        $this->assertEquals($expected, $roman);
    }

    public function lessEqualThan10Case(): array
    {
        return array(
            array(2, "II"),
            array(5, "V"),
            array(10, "X"),
            array(6, "VI"),
            array(4, "IV"),
            array(9, "IX")
        );
    }
}