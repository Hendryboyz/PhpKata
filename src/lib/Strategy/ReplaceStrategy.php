<?php
namespace Kata\Strategy;

interface ReplaceStrategy
{
    public function handle(string $input, array $dictionary): string;
}
?>