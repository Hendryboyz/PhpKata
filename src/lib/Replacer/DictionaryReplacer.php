<?php
declare(strict_types=1);
namespace Kata\Replacer;

final class DictionaryReplacer
{
    public function handle($input, $dictionary) : string
    {
        foreach($dictionary as $key => $val)
        {
            $input = str_replace("\$$key\$", $val, $input);
        }
        return $input;
    }
}
?>