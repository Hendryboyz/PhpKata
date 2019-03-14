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

    private function getScoresAndAssert($expected): void
    {
        $scores = $this->game->getScores();
        $this->assertEquals($expected, $scores);
    }
    
    public function testGivenNormalRolls_WhenRoll_ThenGetCorrectScores(): void
    {
        $this->game->roll(7);
        $this->game->roll(2);
        $this->rollMany(18, 0);
        $this->getScoresAndAssert(9);
    }

    private function rollMany(int $rollTimes, int $pins): void
    {
        for ($i = 0; $i < $rollTimes; $i++)
        {
            $this->game->roll($pins);
        }
    }

    public function testGivenSpare_WhenRoll_TehnGetCorrectScores(): void
    {
        $this->game->roll(7);
        $this->game->roll(3);
        $this->game->roll(9);
        $this->rollMany(17, 0);
        $this->getScoresAndAssert(28);
    }

    public function testGivenStrike_WhenRoll_ThenGetCorrectScores(): void
    {
        $this->game->roll(10);
        $this->game->roll(3);
        $this->game->roll(5);
        $this->rollMany(16, 0);
        $this->getScoresAndAssert(26);
    }

    public function testGivenPerfectGame_WhenRoll_ThenGet300Pointes(): void
    {
        $this->rollMany(12, 10);
        $this->getScoresAndAssert(300);
    }

    public function testGivenMoreThanPins_WhenRoll_ThenThrowInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->game->roll(30);
    }

    /**
     * @dataProvider moreThanPinsCase
     */
    public function testGivenMoreThan10PinsInFrame_WhenRoll_ThrowLogicExceptionException(
        int $firstRoll, int $secondRoll
    ): void
    {
        $this->expectException(LogicException::class);
        $this->game->roll($firstRoll);
        $this->game->roll($secondRoll);
    }

    public function moreThanPinsCase(): array
    {
        return array(
            array(2,10),
            array(12, 1)
        );
    }
}
?>