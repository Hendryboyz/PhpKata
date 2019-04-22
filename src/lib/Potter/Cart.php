<?php
namespace Kata\Potter;

class Cart {
    private const BOOK_PRICE = 8.0;
    private const DISCOUNT = [1, 1, 0.95, 0.9, 0.8, 0.75];

    private $bookStack;

    public function __construct()
    {
        $this->bookStack = array_fill(0, 5, 0);
    }

    public function checkout(array $list) {
        foreach ($list as $eachBook) {
            $this->bookStack[$eachBook]++;
        }
        
        $prices = 0.0;
        while (true) {
            $checkingOutBooks = 0;
            for($bookIndex = 0; $bookIndex < 5; $bookIndex++) {
                if ($this->bookStack[$bookIndex] > 0) {
                    $checkingOutBooks++;
                    $this->bookStack[$bookIndex]--;
                }
            }
            if ($checkingOutBooks > 0) {
                $prices += $checkingOutBooks * self::BOOK_PRICE * self::DISCOUNT[$checkingOutBooks];
            }
            else {
                break;
            }    
        }
        return $prices;
    }
}

?>