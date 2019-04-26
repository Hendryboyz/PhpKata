<?php
declare(strict_types=1);

namespace Kata\Potter;

class Cart {
    public const BOOK_PRICES = 8.0;
    private const DISCOUNT = array(1, 1, 0.95, 0.9, 0.8, 0.75);

    private $bookStack;

    public function __construct()
    {
        $this->bookStack = \array_fill(0, 5, 0);
    }


    public function checkout(array $shoppingCart) {
        foreach ($shoppingCart as $eachBook) {
            $this->bookStack[$eachBook]++;
        }

        $prices = 0;
        $isBookStackEmpty = false;
        $preservedBookStack = 0;
        while (!$isBookStackEmpty) {
            $checkingOutStack = 0;
            for ($bookIndex = 0; $bookIndex < \count($this->bookStack); $bookIndex++) {
                if ($this->bookStack[$bookIndex] > 0) {
                    $this->bookStack[$bookIndex]--;
                    $checkingOutStack++;
                }
            }

            if (0 === $checkingOutStack) {
                $isBookStackEmpty = true;
            }
            else if (5 === $checkingOutStack) {
                $preservedBookStack += 1;
            }
            else if (3 === $checkingOutStack  && $preservedBookStack > 0) {
                $preservedBookStack -= 1;
                $prices += $this->calculateBookStackPrices(4) * 2;
            }
            else {
                $prices += $this->calculateBookStackPrices($checkingOutStack);
            }
        }

        $prices += $this->calculateBookStackPrices(5) * $preservedBookStack;
        return $prices;
    }


    private function calculateBookStackPrices(int $checkingOutStack) {
        return self::BOOK_PRICES * $checkingOutStack * self::DISCOUNT[$checkingOutStack];
    }
}