<?php
declare(strict_types=1);

namespace Kata\Strategy;

define("KEY_NOTATION", "$");

class CharacterReplaceStrategy implements ReplaceStrategy
{
    private $result = "";
    private $findKey = false;
    private $key = "";

    public function __construct()
    {
        
    }

    public function handle(string $input, array $dictionary): string
    {
        foreach (str_split($input) as $element)
        {
            if (KEY_NOTATION == $element)
            {
                $this->handleKeyNotation($dictionary);
                $this->findKey ^= true;
            }
            else
            {
                $this->handleCharacter($element);
            }
        }
        return $this->result;
    }

    private function handleKeyNotation($dictionary): void
    {
        if ($this->findKey)
        {
            $this->result .= $dictionary[$this->key];
        }
        else
        {
            $this->key = "";
        }
    }

    private function handleCharacter($character): void
    {
        if ($this->findKey)
        {
            $this->key .= $character;
        }
        else
        {
            $this->result .= $character;
        }
    }
}
?>