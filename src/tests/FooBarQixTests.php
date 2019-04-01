<?php 
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Kata\Converter\FooBarQixConverter;

class FooBarQixTests extends TestCase {

    private $converter;

    public function testCanCreate() : void {
        $this->converter = new FooBarQixConverter();
        $this->assertNotNull($this->converter);
    }


    public function setUp() : void {
        $this->testCanCreate();
    }


    public function testCanConvert() : void {
        $result = $this->converter->convert(1);
        $this->assertEquals("1", $result);
    }


    /**
     * @dataProvider normalNumber
     */
    public function testGivenNormalNumber_WhenConvert_ThenReturnNumberString(
        int $number,
        string $expected
    ) : void {
        $result = $this->converter->convert($number);
        $this->assertEquals($expected, $result);
    }


    public function normalNumber() : array {
        return array(
            array(2, "2"),
            array(11, "11"),
            array(19, "19"),
            array(61, "61"),
            array(89, "89"),
        );
    }


    /**
     * @dataProvider numberDivisibleByThreeFiveSeven
     */
    public function testGivenNumberDivisibleByThreeFiveSeven_WhenConvert_ThenReturnFooBarQixCombination(
        int $number,
        string $expected
    ) : void {
        $result = $this->converter->convert($number);
        $this->assertEquals($expected, $result);
    }


    public function numberDivisibleByThreeFiveSeven() : array {
        $fooBar = FooBarQixConverter::FOO . FooBarQixConverter::BAR;
        $fooQix = FooBarQixConverter::FOO . FooBarQixConverter::QIX;
        return array(
            array(12, FooBarQixConverter::FOO),
            array(21, $fooQix),
            array(60, $fooBar),
            array(49, FooBarQixConverter::QIX),
            array(10, FooBarQixConverter::BAR)
        );
    }


    /**
     * @dataProvider numberContainThreeFiveSeven
     */
    public function testGivenNumberContainThreeFiveSeven_WhenConvert_ThenReturnFooBarQixCombination(
        int $number,
        string $expected
    ) : void {
        $result = $this->converter->convert($number);
        $this->assertEquals($expected, $result);
    }


    public function numberContainThreeFiveSeven() : array {
        return array(
            array(5, FooBarQixConverter::BAR . FooBarQixConverter::BAR),
            array(3, FooBarQixConverter::FOO . FooBarQixConverter::FOO),
            array(7, FooBarQixConverter::QIX . FooBarQixConverter::QIX),
            array(37, FooBarQixConverter::FOO . FooBarQixConverter::QIX),
            array(35, FooBarQixConverter::BAR . FooBarQixConverter::QIX . 
                FooBarQixConverter::FOO . FooBarQixConverter::BAR)
        );
    }
}

?>