<?php
namespace Kata\Potter;

class Cart {

    private const BOOK_PRICES = 8.0;
    private const DISCOUNT = array(1, 1, .95, .9, .8, .75);

    public function __construct() {
        ;
    }

    public function checkout(array $shoppingCart): float {
        $bookStack = $this->collectBookStack($shoppingCart);
        $prices = 0;
        $isEmptyBookStack = false;
        $preserveBooks = 0;
        while (!$isEmptyBookStack) {
            $checkingOutBooks = $this->collectCheckoutBook($bookStack);
            if ($checkingOutBooks > 0) {
                if ($this->isFullSerial($checkingOutBooks)) {
                    $preserveBooks++;
                }
                else if ($this->isSpcialDiscount($preserveBooks, $checkingOutBooks)) {
                    $preserveBooks--;
                    $prices +=  2 * $this->calculateBookStackPrices(4);
                }
                else {
                    $prices += $this->calculateBookStackPrices($checkingOutBooks);
                }
            }
            else {
                $isEmptyBookStack = true;
            }
        }

        if ($preserveBooks > 0) {
            $prices +=  $preserveBooks * $this->calculateBookStackPrices(5);
        }

        return $prices;
    }

    private function collectBookStack(array $shoppingCart): array {
        $bookStack = array_fill(0, 5, 0);    
        foreach ($shoppingCart as $eachBook) {
            $bookStack[$eachBook]++;
        }
        return $bookStack;
    }

    private function collectCheckoutBook(array &$bookStack): int {
        $checkingOutBooks = 0;
        for ($bookIndex = 0; $bookIndex < 5; $bookIndex++) {
            if ($bookStack[$bookIndex] > 0) {
                $bookStack[$bookIndex]--;
                $checkingOutBooks++;
            }
        }
        return $checkingOutBooks;
    }

    private function isFullSerial($checkingOutBooks) {
        return 5 == $checkingOutBooks;
    }

    private function isSpcialDiscount($preserveBooks, $checkingOutBooks): bool {
        return 3 == $checkingOutBooks && 0 < $preserveBooks;
    }

    private function calculateBookStackPrices($bookCount): float {
        return $bookCount * self::BOOK_PRICES * self::DISCOUNT[$bookCount];
    }
}
?>