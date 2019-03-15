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
        $this->getScoresAndAssert(0);
    }

    private function getScoresAndAssert(int $expected): void
    {
        $scores = $this->game->getScores();
        $this->assertEquals($expected, $scores);
    }

    public function testGivenNormalRoll_WhenRoll_ThenGetCorrectScores(): void
    {
        $this->game->roll(3);
        $this->game->roll(5);
        $this->getScoresAndAssert(8);
    }

    public function testGivenSpare_WhenRoll_ThenGetCorrectScores(): void
    {
        $this->game->roll(5);
        $this->game->roll(5);
        $this->game->roll(9);
        $this->rollMany(17, 0);
        $this->getScoresAndAssert(28);
    }

    private function rollMany(int $rollTimes, int $pins): void
    {
        for ($i = 0; $i < $rollTimes; $i++)
        {
            $this->game->roll($pins);
        }
    }

    public function testGivenStrike_WhenRoll_ThenGetCorrectScores(): void
    {
        $this->game->roll(10);
        $this->game->roll(5);
        $this->game->roll(3);
        $this->rollMany(16, 0);
        $this->getScoresAndAssert(26);
    }

    public function testGivenPerfectGame_WhenRoll_ThenGet300Scores(): void
    {
        $this->rollMany(12, 10);
        $this->getScoresAndAssert(300);
    }

    public function testGivenMoreThan10Pins_WhenRoll_ThenThrowInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->game->roll(12);
    }

    public function testGivenMoreThan10PinsInOneFrame_WhenRoll_ThenThrowLogicException(): void
    {
        $this->expectException(LogicException::class);
        $this->game->roll(5);
        $this->game->roll(7);
    }
}
?>