<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Kata\Converter\FizzBuzzConverter;
use Kata\Strategy\NumberConvertStrategyInterface;
use Kata\Strategy\RealNumberConvertStrategy;

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
            array(2, "2"),
            array(13, "13"),
            array(23, "23"),
            array(79, "79"),
            array(83, "83")
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
            array(21),
            array(33),
            array(42),
            array(57)
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
            array(50),
            array(85)
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
            array(30),
            array(45),
            array(60),
            array(75)
        );
    }


    /**
     * @dataProvider anyNumber
     */
    public function testGivenAnyNumber_WhenConvert_ThenConvertByNumberConvertStrategyInterface(
        int $number,
        string $expected
    ) : void {
        $fakeConvertStrategy = $this->getMockBuilder(NumberConvertStrategyInterface::class)
                                    ->setMethods(['convert'])
                                    ->getMock();

        $fakeConvertStrategy->expects($this->once())
                            ->method("convert")
                            ->with($this->equalTo($number));

        $this->converter->setConvertStrategy($fakeConvertStrategy);
        $this->converter->convert($number);
    }


    public function anyNumber() : array {
        $fizzBuzz = FizzBuzzConverter::FIZZ . FizzBuzzConverter::BUZZ;
        return array(
            array(3, FizzBuzzConverter::FIZZ),
            array(17, "17"),
            array(45, $fizzBuzz),
            array(55, FizzBuzzConverter::BUZZ),
            array(90, $fizzBuzz)
        );
    }


    /**
     * @dataProvider anyNumber
     */
    public function testGivenAnyNumberAndRealNumberConvertStrategy_WhenConvert_ThenReturnResult(
        int $number,
        string $expected
    ) : void {
        $realNumberConvertStrategy = new RealNumberConvertStrategy();

        $this->converter->setConvertStrategy($realNumberConvertStrategy);
        $result = $this->converter->convert($number);
        $this->assertEquals($expected, $result);
    }
}
?>