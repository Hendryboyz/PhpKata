<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Kata\Converter\FizzBuzzConverter;
use Kata\Strategy\NumberConvertStrategyInterface;

class FizzBuzzTests extends TestCase {
    
    private $converter;

    public function testCanCreate(): void {
        $this->converter = new FizzBuzzConverter();
        $this->assertNotNull($this->converter);
    }


    public function setUp(): void {
        $this->testCanCreate();
    }


    public function testCanConvert(): void {
        $result = $this->converter->convert(1);
        $this->assertEquals("1", $result);
    }


    /**
     * @dataProvider numberNotDivisibleBy3Or5
     */
    public function testGivenNumberNotDivisibleBy3Or5_WhenConvert_ThenReturnNumberString(
        int $number,
        string $expected
    ): void {
        $result = $this->converter->convert($number);
        $this->assertEquals($expected, $result);
    }


    public function numberNotDivisibleBy3Or5(): array {
        return array(
            array(2, "2"),
            array(7, "7"),
            array(11, "11"),
            array(13, "13"),
            array(17, "17")
        );
    }


    /**
     * @dataProvider numberDivisibleBy3
     */
    public function testGivenNumberDivisibleBy3_WhenConvert_ThenRetrunFizz(
        int $number
    ): void {
        $result = $this->converter->convert($number);
        $this->assertEquals(FizzBuzzConverter::FIZZ, $result);
    }


    public function numberDivisibleBy3(): array {
        return array(
            array(3),
            array(6),
            array(87),
            array(21),
            array(99)
        );
    }


    /**
     * @dataProvider numberDivisibleBy5
     */
    public function testGivenNumberDivisibleBy5_WhenConvert_ThenReturnBuzz(
        int $number
    ): void {
        $result = $this->converter->convert($number);
        $this->assertEquals(FizzBuzzConverter::BUZZ, $result);
    }


    public function numberDivisibleBy5(): array {
        return array(
            array(5),
            array(20),
            array(65),
            array(25),
            array(95)
        );
    }


    /**
     * @dataProvider numberDivisibleBy3And5
     */
    public function testGivenNumberDivisibleBy3And5_WhenConvert_ThenReturnFizzBuzz(
        int $number
    ): void {
        $result = $this->converter->convert($number);
        $fizzBuzz = FizzBuzzConverter::FIZZ . FizzBuzzConverter::BUZZ;
        $this->assertEquals($fizzBuzz, $result);
    }


    public function numberDivisibleBy3And5(): array {
        return array(
            array(15),
            array(30),
            array(45),
            array(60),
            array(75)
        );
    }


    /**
     * @dataProvider number
     */
    public function testGivenNumber_WhenConvert_ThenConvertByNumberConvertStrategy(
        int $number, 
        string $expected
    ): void {
        $fakeConvertStrategy = $this->getMockBuilder(NumberConvertStrategyInterface::class)
                                    ->setMethods(['convert'])
                                    ->getMock();

        $fakeConvertStrategy->expects($this->once())
                            ->method('convert')
                            ->with($this->equalTo($number));
        
        $this->converter->setConvertStrategy($fakeConvertStrategy);
        $this->converter->convert($number);
    }


    public function number(): array {
        $fizzBuzz = FizzBuzzConverter::FIZZ . FizzBuzzConverter::BUZZ;
        return array(
            array(2, "2"),
            array(3, FizzBuzzConverter::FIZZ),
            array(5, FizzBuzzConverter::BUZZ),
            array(15, $fizzBuzz),
        );
    }
}
?>