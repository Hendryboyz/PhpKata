<?php
declare(strict_types=1);
namespace Kata\Replacer;

use Kata\Strategy\CharacterReplaceStrategy;

final class DictionaryReplacer
{
    private $replaceStrategy;

    public function __construct()
    {
        $numargs = func_num_args();
        if ($numargs == 1)
        {
            $this->replaceStrategy = func_get_arg(0);
        }
        else
        {
            $this->replaceStrategy = new CharacterReplaceStrategy();
        }

    }

    public function handle(string $input, array $dictionary)
    {
        return $this->replaceStrategy->handle($input, $dictionary);
    }
}
?>