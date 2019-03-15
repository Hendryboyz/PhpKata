<?php 
declare(strict_types=1);

namespace Kata\Game;

define('NUM_OF_ROLLS', 21);
define('NUM_OF_PINS', 10);
define('NUM_OF_FRAMES', 10);
define('NORMAL_ROLL_TIME_IN_FRAME', 2);
class Bowling
{
    private $scoreBoard;
    private $rollTimes;
    private $frameStart;

    public function __construct()
    {
        $this->scoreBoard = array(NUM_OF_ROLLS);
        for ($boardIndex = 0; $boardIndex < NUM_OF_ROLLS; $boardIndex++)
        {
            $this->scoreBoard[$boardIndex] = 0;
        }
        $this->rollTimes = 0;
        $this->frameStart = 0;
    }

    public function roll(int $pins): void
    {
        if (NUM_OF_PINS < $pins)
        {
            throw new \InvalidArgumentException();
        }
        $this->scoreBoard[$this->rollTimes++] = $pins;
        if (NUM_OF_PINS < $this->getNormalScores($this->frameStart))
        {
            throw new \LogicException();
        }
        else if (NUM_OF_PINS == $pins || $this->isFrameOver())
        {
            $this->frameStart = $this->rollTimes;
        }
    }

    private function isFrameOver(): bool
    {
        return $this->rollTimes == $this->frameStart + NORMAL_ROLL_TIME_IN_FRAME;
    }

    public function getScores(): int
    {
        $scores = 0;
        $boardIndex = 0;
        for ($frame = 0; $frame < NUM_OF_FRAMES; $frame++)
        {
            $rollInFrame = NORMAL_ROLL_TIME_IN_FRAME;
            if ($this->isStrike($boardIndex))
            {
                $rollInFrame = 1;
                $bonus = $this->scoreBoard[$boardIndex + 1] + $this->scoreBoard[$boardIndex + 2];
                $scores += NUM_OF_PINS +  $bonus;
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
        return NUM_OF_PINS == $this->scoreBoard[$boardIndex] + $this->scoreBoard[$boardIndex + 1];
    }

    private function getNormalScores($boardIndex): int
    {
        return $this->scoreBoard[$boardIndex] + $this->scoreBoard[$boardIndex + 1];
    }
}
?>