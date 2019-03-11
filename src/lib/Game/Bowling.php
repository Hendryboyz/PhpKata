<?php
declare(strict_types=1);

namespace Kata\Game;

define('NUM_OF_ROLLS', 21);
define('NUM_OF_PINS', 10);
define('NORMAL_ROLL_TIMES_IN_FRAME', 2);

class Bowling
{
    private $scoresBoard;
    private $rollTimes;

    public function __construct()
    {
        $this->rollTimes = 0;
        $this->scoresBoard = array(NUM_OF_ROLLS);
        for ($i = 0; $i < NUM_OF_ROLLS; $i++)
        {
            $this->scoresBoard[$i] = 0;
        }
    }

    public function roll(int $pins): void
    {
        // $this->scoresBoard[] = $pins;
        $this->scoresBoard[$this->rollTimes++] = $pins;
    }

    public function getScores(): int
    {
        $scores = 0;
        for ($i = 0; $i < NUM_OF_ROLLS - 1; $i += NORMAL_ROLL_TIMES_IN_FRAME)
        {
            if ($this->isSpare($i))
            {
                $bonus = $this->scoresBoard[$i + 2];
                $scores += $this->scoresBoard[$i] + $this->scoresBoard[$i + 1] + $bonus;
            }
            else
            {
                $scores += $this->scoresBoard[$i] + $this->scoresBoard[$i + 1];
            }
        }
        return $scores;
    }

    private function isSpare($rollIndex): bool
    {
        return ($this->scoresBoard[$rollIndex] + $this->scoresBoard[$rollIndex + 1]) === NUM_OF_PINS;
    }
}
?>