<?php 
declare(strict_types = 1);

namespace Kata\Potter;

class Cart {

    private const WHOLE_SERIES_COUNT = 5;
    private const BOOK_PRICE = 8.0;
    private const DISCOUNT = array(1, 1, 0.95, 0.9, 0.8, 0.75);

    public function __construct() {
        
    }

    public function checkout(array $shoppingCart): float {
        $bookStack = $this->collectBookStack($shoppingCart);
        $total = 0.0;
        $isEmptyBookStack = false;
        $preserveBookStack = 0;
        while (!$isEmptyBookStack) {
            $checkingOutBooks = $this->getCheckingOutBooks($bookStack);
            if ($checkingOutBooks > 0) {
                if ($this->isWholeSeries($checkingOutBooks)) {
                    $preserveBookStack++;
                }
                else if ($this->isSpecialDiscount($checkingOutBooks, $preserveBookStack)) {
                    $preserveBookStack--;
                    $total += 2 * $this->calculateBookPirce(4);
                }
                else {
                    $total += $this->calculateBookPirce($checkingOutBooks);
                }
            }
            else {
                $isEmptyBookStack = true;
            }
        }

        if ($preserveBookStack > 0) {
            $total += $preserveBookStack * $this->calculateBookPirce(5);
        }
        return $total;
    }

    private function collectBookStack(array $shoppingCart): array {
        $bookStack = array_fill(0, self::WHOLE_SERIES_COUNT, 0);
        foreach ($shoppingCart as $eachBook) {
            if (self::WHOLE_SERIES_COUNT <= $eachBook) {
                throw new \InvalidArgumentException();
            }
            $bookStack[$eachBook]++;
        }
        return $bookStack;
    }

    private function getCheckingOutBooks(array &$bookStack): int {
        $checkingOutBooks = 0;
        for ($bookIndex = 0; $bookIndex < count($bookStack); $bookIndex++) {
            if ($bookStack[$bookIndex] > 0) {
                $bookStack[$bookIndex]--;
                $checkingOutBooks++;
            }
        }
        return $checkingOutBooks;
    }

    private function isWholeSeries($bookCount): bool {
        return self::WHOLE_SERIES_COUNT == $bookCount;
    }

    private function isSpecialDiscount($bookCount, $preserveSeries): bool {
        return 3 == $bookCount && $preserveSeries > 0;
    }

    private function calculateBookPirce(int $booksCount): float {
        return $booksCount * self::BOOK_PRICE * self::DISCOUNT[$booksCount];
    }
}
?>