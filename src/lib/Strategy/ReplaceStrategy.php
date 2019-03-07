<?php
declare(strict_types=1);

namespace Kata\Strategy;

interface ReplaceStrategy
{
    public function handle(string $input, array $dictionary): string;
}
?>