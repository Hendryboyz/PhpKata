<?php
declare(strict_types=1);
namespace Kata\Strategy;

class CharacterReplaceStrategy implements ReplaceStrategy
{
    private $result;
    private $findKey;
    private $key;

    public function __construct()
    {
    }

    public function handle(string $input,array $dictionary): string
    {
        $this->result = "";
        $this->findKey = false;
        $this->key = "";

        foreach (str_split($input) as $element)
        {
            if ($element === '$')
            {
                $this->handleKey($dictionary);
            }
            else
            {
                $this->handleCharacter($element);
            }
        }
        return $this->result;
    }

    private function handleKey(array $dictionary)
    {
        if ($this->findKey)
        {
            $this->result .= $dictionary[$this->key];
        }
        else
        {
            $this->key = "";
        }
        $this->findKey ^= true;
    }

    private function handleCharacter(string $element)
    {
        if ($this->findKey)
        {
            $this->key .= $element;
        }
        else
        {
            $this->result .= $element;
        }
    }
}
?>