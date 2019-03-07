<?php
declare(strict_types=1);

namespace Kata\Replacer;

use Kata\Strategy\StrReplaceStrategy;


class DictionaryReplacer
{
    private $replaceStrategy;

    public function __construct()
    {
        if (func_num_args() == 1)
        {
            $this->replaceStrategy = \func_get_arg(0); 
        }
        else
        {
            $this->replaceStrategy = new StrReplaceStrategy();
        }
    }

    public function handle(string $input, array $dictionary): string
    {
        if (isset($this->replaceStrategy))
        {
            return $this->replaceStrategy->handle($input, $dictionary);
        }
        else
        {
            return "";
        }
    }
}
?>