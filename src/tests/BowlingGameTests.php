<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Kata\Game\Bowling;

final class BowlingGameTests extends TestCase
{
    private $game;

    public function testCanCreate(): void
    {
        $this->game = new Bowling();
        $this->assertNotNull($this->game);
    }

    public function setUp(): void
    {
        $this->testCanCreate();
    }

    public function testCanRollAndGetScores(): void
    {
        $this->game->roll(0);
        $this->game->roll(0);
        $this->getScoresAnsAssert(0);
    }

    private function getScoresAnsAssert(int $exptected):void
    {
        $scores = $this->game->getScores();
        $this->assertEquals($exptected, $scores);
    }

    public function testGivenNormalPins_WhenRoll_ThenReturnScores(): void
    {
        $this->game->roll(5);
        $this->game->roll(3);
        $this->rollMany(17, 0);
        $this->getScoresAnsAssert(8);
    }

    private function rollMany(int $rollTimes, int $pins): void
    {
        for ($i = 0; $i < $rollTimes; $i++)
        {
            $this->game->roll($pins);
        }
    }

    public function testGivenSpare_WhenRoll_ThenReturnScores(): void
    {
        $this->game->roll(5);
        $this->game->roll(5);
        $this->game->roll(7);
        $this->rollMany(17, 0);
        $this->getScoresAnsAssert(24);
    }
}
?>