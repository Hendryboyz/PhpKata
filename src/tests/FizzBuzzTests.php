<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Kata\Converter\FizzBuzzConverter;
use Kata\Strategy\NumberConvertStrategyInterface;
use Kata\Strategy\NumberConvertStrategy;
use Kata\Strategy\FizzBuzzNumberConverterDecorator;

class FizzBuzzTests extends TestCase {
    private $converter;

    public function testCanCreate() : void {
        $this->converter = new FizzBuzzConverter();
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
     * @dataProvider numberNotDivisibleBy3Or5
     */
    public function testGivenNumberNotDivisibleBy3Or5_WhenConvert_ThenReturnNumberString(
        int $number,
        string $expected
    ) : void {
        $result = $this->converter->convert($number);
        $this->assertEquals($expected, $result);
    }


    public function numberNotDivisibleBy3Or5() : array {
        return array(
            array(1, "1"),
            array(97, "97"),
            array(19, "19"),
            array(37, "37"),
            array(67, "67")
        );
    }


    /**
     * @dataProvider numberDivisibleBy3
     */
    public function testGivenNumberDivisibleBy3_WhenConvert_ThenReturnFizz(
        int $number
    ) : void {
        $result = $this->converter->convert($number);
        $this->assertEquals(FizzBuzzConverter::FIZZ, $result);
    }


    public function numberDivisibleBy3() : array {
        return array(
            array(3),
            array(69),
            array(96),
            array(18),
            array(24)
        );
    }


    /**
     * @dataProvider numberDivisibleBy5
     */
    public function testGivenNumberDivisibleBy5_WhenConvert_ThenReturnBuzz(
        int $number
    ) : void {
        $result = $this->converter->convert($number);
        $this->assertEquals(FizzBuzzConverter::BUZZ, $result);
    }


    public function numberDivisibleBy5() : array {
        return array(
            array(5),
            array(35),
            array(65),
            array(95),
            array(40)
        );
    }


    /**
     * @dataProvider numberDivisibleBy3And5
     */
    public function testGivenNumberDivisibleBy3And5_WhenConvert_ThenReturnFizzBuzz(
        int $number
    ) : void {
        $result = $this->converter->convert($number);
        $fizzBuzz = FizzBuzzConverter::FIZZ . FizzBuzzConverter::BUZZ;
        $this->assertEquals($fizzBuzz, $result);
    }


    public function numberDivisibleBy3And5() : array {
        return array(
            array(15),
            array(60),
            array(30),
            array(75),
            array(45)
        );
    }


    public function testGivenNumberAndConvertStrategy_WhenConvert_ThenConvertByStrategy() : void {
        $givenNumber = 30;
        $fakeNumberConvertStrategy = $this->getMockBuilder(NumberConvertStrategyInterface::class)
                                          ->setMethods(["convert"])
                                          ->getMock();
        $fakeNumberConvertStrategy->expects($this->once())
                                  ->method('convert')
                                  ->with($this->equalTo($givenNumber));
        
        $this->converter->setConvertStrategy($fakeNumberConvertStrategy);
        $this->converter->convert($givenNumber);
    }


    /**
     * @dataProvider randomNumber
     */
    public function testGivenRandomNumber_WhenConvert_ThenReturnNumberString(
        int $number,
        string $expected
    ) : void {
        $numberConvertStrategy = new NumberConvertStrategy();
        $fizzBuzzConvertDecoratore = 
            new FizzBuzzNumberConverterDecorator($numberConvertStrategy);
        $this->converter->setConvertStrategy($fizzBuzzConvertDecoratore);

        $result = $this->converter->convert($number);

        $this->assertEquals($expected, $result);
    }


    public function randomNumber() : array {
        $fizzBuzz = FizzBuzzConverter::FIZZ . FizzBuzzConverter::BUZZ;
        return array(
            array(45, $fizzBuzz),
            array(95, FizzBuzzConverter::BUZZ),
            array(24, FizzBuzzConverter::FIZZ),
            array(37, "37"),
            array(89, "89")
        );
    }
}
?>