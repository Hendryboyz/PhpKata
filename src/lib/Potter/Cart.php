<?php

namespace Kata\Potter;

class Cart {
    private const BOOK_PRICES = 8.0;
    private const DISCOUNT = array(1, 1, 0.95, 0.9, 0.8, 0.75);

    private $bookStack;

    public function __construct() {
        $this->bookStack = \array_fill(0, 5, 0);    
    }

    public function checkout(array $shoppingCart): float {
        $this->integrateBookStak($shoppingCart);

        $total = 0.0;
        $isEmptyBookStack = false;
        $preserveBooks = 0;
        while (!$isEmptyBookStack) {
            $checkingOutBooks = $this->getCheckingOutBooks();
            if ($checkingOutBooks > 0) {
                if (5 == $checkingOutBooks) {
                    $preserveBooks++;
                }
                else if (3 == $checkingOutBooks && $preserveBooks > 0) {
                    $preserveBooks--;
                    $total += 2 * $this->calculateBooksPrices(4);
                }
                else {
                    $total += $this->calculateBooksPrices($checkingOutBooks);
                }
            }
            else {
                $isEmptyBookStack = true;
            }
        }

        if ($preserveBooks > 0) {
            $total += $preserveBooks * $this->calculateBooksPrices(5);
        }
        return $total;
    }

    private function integrateBookStak($cart): void {
        foreach ($cart as $bookIndex) {
            $this->bookStack[$bookIndex]++;
        }
    }

    private function getCheckingOutBooks(): int {
        $checkingOutBooks = 0;
        for ($bookIndex = 0; $bookIndex < \count($this->bookStack); $bookIndex++) {
            if ($this->bookStack[$bookIndex] > 0) {
                $this->bookStack[$bookIndex]--;
                $checkingOutBooks++;
            }
        }
        return $checkingOutBooks;
    }

    private function calculateBooksPrices($bookSize): float {
        return self::BOOK_PRICES * $bookSize * self::DISCOUNT[$bookSize];
    }
}
?>