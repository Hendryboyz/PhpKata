<?php
declare(strict_types = 1);
use PHPUnit\Framework\TestCase;
use Kata\Potter\Cart;

class PotterKataTest extends TestCase {

    private $cart;
    
    public function testCanCreate(): void {
        $this->cart = new Cart();
        $this->assertNotNull($this->cart);
    }

    public function setUp(): void {
        $this->testCanCreate();
    }

    public function testCanCheckout(): void {
        $this->checkoutAndAssert([0], 8.0);
    }

    private function checkoutAndAssert(array $books, float $expected): void {
        $prices = $this->cart->checkout($books);
        $this->assertEquals($expected, $prices);
    }

    /**
     * @dataProvider sameBookOrder
     */
    public function testGivenSameBookOrder_WhenCheckout_ThenReturnTotal(
        array $books,
        float $expected
    ): void {
        $this->checkoutAndAssert($books, $expected);
    }

    public function sameBookOrder(): array {
        return array(
            array([1, 1], 16.0),
            array([2, 2, 2], 24.0),
            array([3, 3, 3, 3], 32.0),
            array([4, 4, 4, 4, 4], 40.0),
        );
    }

    /**
     * @dataProvider basicDiscount
     */
    public function testGivenBasicDiscount_WhenCheckout_ThenReturnDiscountTotal(
        array $books,
        float $expected
    ): void {
        $this->checkoutAndAssert($books, $expected);
    }

    public function basicDiscount() : array {
        return array(
            array([0, 1], 16.0 * 0.95),
            array([0, 2, 4], 24.0 * 0.9),
            array([0, 1, 2, 4], 32.0 * 0.8),
            array([0, 1, 2, 3, 4], 40.0 * 0.75),
        );
    }

    /**
     * @dataProvider multipleDiscount
     */
    public function testGivenMultipleDiscount_WhenCheckout_ThenReturnDiscountTotal(
        array $books,
        float $expected
    ): void {
        $this->checkoutAndAssert($books, $expected);
    }
    
    public function multipleDiscount(): array {
        return array(
            array([0, 0, 1], 8 + (8 * 2 * 0.95)),
            array([0, 0, 1, 1], 2 * (8 * 2 * 0.95)),
            array([0, 0, 1, 2, 2, 3], (8 * 4 * 0.8) + (8 * 2 * 0.95)),
            array([0, 1, 1, 2, 3, 4], 8 + (8 * 5 * 0.75))
        );
    }

    /**
     * @dataProvider specialDiscount
     */
    public function testGivenSpecialDiscount_WhenCheckout_ThenReturnSpecialDiscount(
        array $books,
        float $expected
    ): void {
        $this->checkoutAndAssert($books, $expected);    
    }

    public function specialDiscount(): array {
        return array(
            array([0, 0, 1, 1, 2, 2, 3, 4], 2 * (8 * 4 * 0.8)),
            array([0, 0, 0, 0, 0, 
            1, 1, 1, 1, 1, 
            2, 2, 2, 2, 
            3, 3, 3, 3, 3, 
            4, 4, 4, 4], 3 * (8 * 5 * 0.75) + 2 * (8 * 4 * 0.8))
        );
    }

    public function testGivenIndexNotInSeries_WhenCheckout_ThenThrowInvalidArgumentException(): void {
        $this->expectException(\InvalidArgumentException::class);
        $this->cart->checkout([6]);
    }
}
?>