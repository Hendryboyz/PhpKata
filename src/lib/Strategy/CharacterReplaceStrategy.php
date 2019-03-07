<?php
declare(strict_types=1);

namespace Kata\Strategy;

class CharacterReplaceStrategy implements ReplaceStrategy
{
    private $result = "";
    private $findKey = false;
    private $key = "";

    public function __construct()
    {
        ;
    }

    public function handle(string $input, array $dictionary): string
    {
        
        foreach (\str_split($input) as $element)
        {
            if ("$" == $element)
            {
                $this->handleDollarSign($dictionary);
            }
            else
            {
                $this->handlElement($element);
            }
        }
        return $this->result;
    }

    private function handleDollarSign(array $dictionary): void
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

    private function handlElement($element): void
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