<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Kata\Converter\FizzBuzzConverter;

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
     * @dataProvider numberDivisibleBy3
     */
    public function testGivenNumberDivisibleBy3_WhenConvert_ThenReturnFizz(
        int $number
    ): void {
        $result = $this->converter->convert($number);
        $this->assertEquals(FizzBuzzConverter::FIZZ, $result);
    }


    public function numberDivisibleBy3(): array {
        return array(
            array(3),
            array(6),
            array(9),
            array(12)
        );
    }

    
    /**
     * @dataProvider numberDivisbleBy5
     */
    public function testGivenNumberDivisibleBy5_WhenConvert_ThenReturnBuzz(
        int $number
    ): void {
        $result = $this->converter->convert($number);
        $this->assertEquals(FizzBuzzConverter::BUZZ, $result);
    }

    
    public function numberDivisbleBy5(): array {
        return array(
            array(5),
            array(10),
            array(20)
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
            array(30)
        );
    }
}
?>