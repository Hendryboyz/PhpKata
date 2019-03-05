<?php
declare(strict_types=1);

namespace Kata\Replacer;

class DictionaryReplacer {

    private $replaceStrategy;

    public function __construct()
    {
        if (func_num_args() == 1)
        {
            $this->replaceStrategy = func_get_arg(0);
        }
    }

    public function handle(string $input, array $dictionary): string
    {
        if (isset($this->replaceStrategy))
        {
            return $this->replaceStrategy->handle($input, $dictionary);
        }
        // return $this->handleWithStrReplace($input, $dictionary);
        return $this->handleWithCharacterReplacer($input, $dictionary);
    }

    private function handleWithCharacterReplacer(string $input, array $dictionary): string
    {
        $result = "";
        $findKey = false;
        $key = "";
        foreach (str_split($input) as $element)
        {
            if ($element === "$")
            {
                if ($findKey)
                {
                    $result .= $dictionary[$key];
                }
                else
                {
                    $key = "";
                }
                $findKey ^= true;
            }
            else
            {
                if ($findKey)
                {
                    $key .= $element;
                }
                else
                {
                    $result .= $element; 
                }
            }
        }
        return $result;
    }

    private function handleWithStrReplace(string $input, array $dictionary): string
    {
        foreach ($dictionary as $key => $val)
        {
            $input = str_replace("\$$key\$", $val, $input);
        }
        return $input;
    }
}
?>