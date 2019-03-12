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

    public function testGivenNormalPins_WhenRoll_ThenGetCorrectScores(): void
    {
        $this->game->roll(3);
        $this->game->roll(4);
        $this->rollMany(18, 0);
        $this->getScoresAndAssert(7);
    }

    private function rollMany(int $rollTimes, int $pins): void
    {
        for ($i = 0; $i < $rollTimes; $i++)
        {
            $this->game->roll($pins);
        }
    }

    public function testGivenSpare_WhenRoll_ThenGetCorrectScores(): void
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
        $this->game->roll(6);
        $this->rollMany(16, 0);
        $this->getScoresAndAssert(28);
    }

    public function testGivenPerfect_WhenRoll_ThenGet300Points(): void
    {
        $this->rollMany(12, 10);
        $this->getScoresAndAssert(300);
    }

    /**
     * @dataProvider moreThanTenPinsRoll
     */
    public function testGivenMoreThan10Pins_WhenRoll_ThenThrowException($firstRoll, $secondRoll): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->game->roll($firstRoll);
        $this->game->roll($secondRoll);
    }

    public function moreThanTenPinsRoll(): array
    {
        return array(
            array(11, 0),
            // array(6, 5),
        );
    }
}
?>