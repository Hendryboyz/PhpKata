<?php
namespace Kata\Potter;

class Cart {

    private const WHOLE_SERIES = 5;
    private const BOOK_PRICES = 8.0;
    private const DISCOUNT = array(1, 1, 0.95, 0.9, 0.8, 0.75);

    public function checkout(array $shoppingCart): float {
        $bookStack = $this->collectBookStack($shoppingCart);
        $total = 0.0;
        $isEmptyBookStack = false;
        $preserveSeries = 0;
        while (!$isEmptyBookStack) {
            $checkingOutBooks = $this->getCheckingOutBooks($bookStack);
            if ($checkingOutBooks > 0) {
                if (self::WHOLE_SERIES == $checkingOutBooks) {
                    $preserveSeries++;
                }
                else if (3 == $checkingOutBooks && 0 < $preserveSeries) {
                    $preserveSeries--;
                    $total += 2 * $this->calculatePrices(4);
                }
                else {
                    $total += $this->calculatePrices($checkingOutBooks);
                }
            }
            else {
                $isEmptyBookStack = true;
            }
        }

        if ($preserveSeries > 0) {
            $total += $preserveSeries * $this->calculatePrices(self::WHOLE_SERIES);
        }
        return $total;
    }

    private function collectBookStack(array $shoppingCart): array {
        $bookStack = array_fill(0, self::WHOLE_SERIES, 0);
        foreach ($shoppingCart as $eachBook) {
            if (self::WHOLE_SERIES <= $eachBook) {
                throw new \InvalidArgumentException();
            }
            $bookStack[$eachBook]++;
        }
        return $bookStack;
    }

    private function getCheckingOutBooks(array &$bookStack): int {
        $checkingOutBooks = 0;
        for($bookIndex = 0; $bookIndex < self::WHOLE_SERIES; $bookIndex++) {
            if ($bookStack[$bookIndex] > 0) {
                $bookStack[$bookIndex]--;
                $checkingOutBooks++;
            }
        }
        return $checkingOutBooks;
    }

    private function calculatePrices(int $bookCount) {
        return self::BOOK_PRICES * $bookCount * self::DISCOUNT[$bookCount];
    }
} 
?>