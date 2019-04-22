<?php 
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use Kata\Converter\FooBarQixConverter;

class FooBarQixTest extends TestCase {
    private $converter;

    public function testCanCreate() : void {
        $this->converter = new FooBarQixConverter();
        $this->assertNotNull($this->converter);
    }


    public function setUp() : void {
        $this->testCanCreate();
    }


    public function testCanConvert() : void {
        $this->convertAndAssert(1, "1");
    }


    /**
     * @dataProvider notFooBarQixPrime
     */
    public function testGivenNotFooBarQixPrime_WhenConvert_ThenReturnNumberString(
        int $number, 
        string $expected
    ) : void {
        $this->convertAndAssert($number, $expected);
    }


    public function notFooBarQixPrime() : array {
        return array(
            array(2, "2"),
            array(61, "61"),
            array(19, "19"),
            array(29, "29"),
            array(89, "89")
        );
    }


    /**
     * @dataProvider numberDivisibleByThreeFiveSeven
     */
    public function testGivenFooBarQixDivisibleNumber_WhenConvert_ThenReturnFooBarQixCombination(
        int $number,
        string $expected
    ) : void {
        $this->convertAndAssert($number, $expected);
    }

    
    private function convertAndAssert(int $number, string $expected) : void {
        $result = $this->converter->convert($number);
        $this->assertEquals($expected, $result);
    }


    public function numberDivisibleByThreeFiveSeven() : array {
        $fooBar = FooBarQixConverter::FOO . FooBarQixConverter::BAR;
        $fooQix = FooBarQixConverter::FOO . FooBarQixConverter::QIX;
        return array(
            array(12, FooBarQixConverter::FOO),
            array(49, FooBarQixConverter::QIX),
            array(10, FooBarQixConverter::BAR . FooBarQixConverter::STAR_SIGN),
            array(21, $fooQix),
            array(60, $fooBar . FooBarQixConverter::STAR_SIGN)
        );
    }


    /**
     * @dataProvider numberContainsThreeFiveSeven
     */
    public function testGivenNumberContainsFooBarQix_WhenConvert_ThenReturnFooBarQixCombination(
        int $number,
        string $expected
    ) : void {
        $this->convertAndAssert($number, $expected);
    }


    public function numberContainsThreeFiveSeven() : array {
        return array(
            array(5, FooBarQixConverter::BAR . FooBarQixConverter::BAR),
            array(3, FooBarQixConverter::FOO . FooBarQixConverter::FOO),
            array(7, FooBarQixConverter::QIX . FooBarQixConverter::QIX),
            array(37, FooBarQixConverter::FOO . FooBarQixConverter::QIX),
            array(35, FooBarQixConverter::BAR . FooBarQixConverter::QIX . 
                FooBarQixConverter::FOO . FooBarQixConverter::BAR)
        );
    }


    /**
     * @dataProvider numberContainZero
     */
    public function testGivenNumberContainZero_WhenConvert_ThenReturnStringContainStarSign(
        int $number,
        string $expected
    ) : void {
        $this->convertAndAssert($number, $expected);
    }


    public function numberContainZero() : array {
        return array(
            array(101, "1*1"),
            array(303, FooBarQixConverter::FOO . FooBarQixConverter::FOO . "*" . FooBarQixConverter::FOO),
            array(105, FooBarQixConverter::FOO . FooBarQixConverter::BAR . 
                FooBarQixConverter::QIX . "*" . FooBarQixConverter::BAR),
            array(10101, FooBarQixConverter::FOO . FooBarQixConverter::QIX . "**")
        );
    }
}

?>