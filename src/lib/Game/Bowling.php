<?php 
declare(strict_types=1);

namespace Kata\Game;

use SebastianBergmann\RecursionContext\InvalidArgumentException;

define('NUM_OF_ROLLS', 21);
define('NUM_OF_PINS', 10);
define('NUM_OF_FRAMES', 10);
define('NORMAL_ROLL_TIMES_IN_FRAME', 2);

class Bowling {
    private $scoreBoard;
    private $rollTimes;

    public function __construct()
    {
        $this->scoreBoard = array(NUM_OF_ROLLS);
        for ($i = 0; $i < NUM_OF_ROLLS; $i++)
        {
            $this->scoreBoard[$i] = 0;
        }
        $this->rollTimes = 0;
    }

    public function roll(int $pins): void
    {
        $this->pinValidation($pins);
        $this->scoreBoard[$this->rollTimes++] = $pins;
    }

    private function pinValidation($pins): void
    {
        if ($pins > NUM_OF_PINS)
        {
            throw new InvalidArgumentException();
        }
    }

    public function getScores(): int
    {
        $scores = 0;
        $boardIndex = 0;
        for ($frameIndex = 0; $frameIndex < NUM_OF_FRAMES; $frameIndex++)
        {
            $rollInFrame = NORMAL_ROLL_TIMES_IN_FRAME;
            if ($this->isStrike($boardIndex))
            {
                $bonus = $this->scoreBoard[$boardIndex + 1] + $this->scoreBoard[$boardIndex + 2];
                $scores += $this->scoreBoard[$boardIndex] + $bonus;
                $rollInFrame = 1;
            }
            else if ($this->isSpare($boardIndex))
            {
                $bonus = $this->scoreBoard[$boardIndex + 2];
                $scores += $this->getNormalScores($boardIndex) + $bonus;
            }
            else
            {
                $scores += $this->getNormalScores($boardIndex);
            }
            $boardIndex += $rollInFrame;
        }
        return $scores;
    }

    private function isStrike($boardIndex): bool
    {
        return NUM_OF_PINS == $this->scoreBoard[$boardIndex];
    }

    private function isSpare($boardIndex): bool
    {
        return NUM_OF_PINS == ($this->scoreBoard[$boardIndex] + $this->scoreBoard[$boardIndex + 1]);
    }

    private function getNormalScores($boardIndex): int
    {
        return $this->scoreBoard[$boardIndex] + $this->scoreBoard[$boardIndex + 1];
    }
}
?>