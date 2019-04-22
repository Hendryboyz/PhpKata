<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class PotterKataTest extends TestCase {

    private $cart;


    public function testCanCreate() : void {
        $this->cart = new Kata\Potter\Cart();
        $this->assertNotNull($this->cart);
    }


    public function setUp() : void {
        $this->testCanCreate();
    }

    public function testCanCheckout() : void {
        $this->checkoutAndAssert([0], 8.0);
    }

    private function checkoutAndAssert(array $list, float $expected) : void {
        $prices = $this->cart->checkout($list);
        $this->assertEquals($expected, $prices);
    }

    /**
     * @dataProvider sameBookOrder
     */
    public function testGivenSameBookOrder_WhenCheckout_ThenReturnPrice(
        array $books, 
        float $expected
    ) : void {
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
    public function testGivenBasicDiscount_WhenCheckout_ThenReturnCorrectDiscountPrice(
        array $books,
        float $expected
    ) : void {
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
}
?>