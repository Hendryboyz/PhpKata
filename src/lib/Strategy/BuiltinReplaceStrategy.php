<?php
declare(strict_types=1);
namespace Kata\Strategy;

class BuiltinReplaceStrategy implements ReplaceStrategy
{
    public function __construct()
    {
        
    }

    public function handle(string $input,array $dictionary): string
    {
        foreach ($dictionary as $key => $val)
        {
            $input = str_replace("\$$key\$", $val, $input);
        }
        return $input;
    }
}

?>